<?php

namespace App\Http\Controllers\Api\leads;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        $query = Lead::query()->orderByDesc('created_at');
        return response()->json($query->paginate(50));
    }

    public function statistics()
    {
        return response()->json([
            'total' => Lead::count(),
            'unread' => Lead::where('is_read', false)->count(),
            'by_type' => Lead::selectRaw('type, COUNT(*) as count')->groupBy('type')->pluck('count', 'type'),
            'by_status' => Lead::selectRaw('status, COUNT(*) as count')->groupBy('status')->pluck('count', 'status'),
        ]);
    }

    public function unreadCount()
    {
        return response()->json(['unread' => Lead::where('is_read', false)->count()]);
    }

    public function show(Lead $lead)
    {
        return response()->json($lead);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'type' => 'nullable|string|max:50',
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'data' => 'nullable|array',
        ]);

        $lead = Lead::create([
            'type' => $data['type'] ?? 'contact',
            'name' => $data['name'],
            'email' => $data['email'] ?? null,
            'phone' => $data['phone'] ?? null,
            'subject' => $data['subject'] ?? null,
            'message' => $data['message'] ?? null,
            'data' => $data['data'] ?? null,
            'status' => 'new',
            'is_read' => false,
            'read_at' => null,
        ]);

        return response()->json($lead, 201);
    }

    public function markAsRead(Lead $lead)
    {
        $lead->update(['is_read' => true, 'read_at' => now()]);
        return response()->json(['success' => true]);
    }

    public function update(Request $request, Lead $lead)
    {
        $data = $request->validate([
            'status' => 'nullable|string|max:50',
            'notes' => 'nullable|string',
            'assigned_to' => 'nullable|integer',
            'is_read' => 'nullable|boolean',
        ]);
        if (array_key_exists('is_read', $data) && $data['is_read'] === true) {
            $data['read_at'] = now();
        }
        $lead->update($data);
        return response()->json($lead);
    }

    public function destroy(Lead $lead)
    {
        $lead->delete();
        return response()->json(['success' => true]);
    }

    public function exportCsv()
    {
        $rows = Lead::query()->orderByDesc('created_at')->get();

        $csv = "id,type,name,email,phone,subject,status,is_read,created_at\n";
        foreach ($rows as $r) {
            $csv .= implode(',', [
                $r->id,
                $this->esc($r->type),
                $this->esc($r->name),
                $this->esc($r->email),
                $this->esc($r->phone),
                $this->esc($r->subject),
                $this->esc($r->status),
                $r->is_read ? '1' : '0',
                $r->created_at,
            ]) . "\n";
        }

        return response($csv, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="leads.csv"',
        ]);
    }

    private function esc($v): string
    {
        $s = (string) ($v ?? '');
        $s = str_replace('"', '""', $s);
        return "\"{$s}\"";
    }
}


