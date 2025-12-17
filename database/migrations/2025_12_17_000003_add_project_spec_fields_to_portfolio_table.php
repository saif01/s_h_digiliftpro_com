<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('portfolio', function (Blueprint $table) {
            if (!Schema::hasColumn('portfolio', 'short_description')) {
                $table->text('short_description')->nullable()->after('description');
            }
            if (!Schema::hasColumn('portfolio', 'type')) {
                $table->string('type')->nullable()->after('industry'); // Website / Web App / System
            }
            if (!Schema::hasColumn('portfolio', 'platform')) {
                $table->string('platform')->nullable()->after('type'); // Web / Mobile Responsive
            }
            if (!Schema::hasColumn('portfolio', 'status')) {
                $table->string('status')->default('live')->after('platform'); // live / in_progress / private
            }
            if (!Schema::hasColumn('portfolio', 'year')) {
                $table->unsignedSmallInteger('year')->nullable()->after('status');
            }

            // Structured spec fields for the "Single Project Details" template
            if (!Schema::hasColumn('portfolio', 'technology_stack')) {
                $table->json('technology_stack')->nullable()->after('videos'); // {frontend, backend, db}
            }
            if (!Schema::hasColumn('portfolio', 'hosting')) {
                $table->string('hosting')->nullable()->after('technology_stack');
            }
            if (!Schema::hasColumn('portfolio', 'security')) {
                $table->json('security')->nullable()->after('hosting'); // {ssl, backups, roles_permissions, notes}
            }
            if (!Schema::hasColumn('portfolio', 'integrations')) {
                $table->json('integrations')->nullable()->after('security'); // ["Payment","SMS",...]
            }
            if (!Schema::hasColumn('portfolio', 'modules')) {
                $table->json('modules')->nullable()->after('integrations'); // ["Admin dashboard", ...]
            }
            if (!Schema::hasColumn('portfolio', 'timeline')) {
                $table->string('timeline')->nullable()->after('modules');
            }
            if (!Schema::hasColumn('portfolio', 'support_plan')) {
                $table->string('support_plan')->nullable()->after('timeline');
            }
            if (!Schema::hasColumn('portfolio', 'key_features')) {
                $table->json('key_features')->nullable()->after('support_plan'); // ["Role-based access control", ...]
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolio', function (Blueprint $table) {
            $columns = [
                'short_description',
                'type',
                'platform',
                'status',
                'year',
                'technology_stack',
                'hosting',
                'security',
                'integrations',
                'modules',
                'timeline',
                'support_plan',
                'key_features',
            ];

            $existing = array_values(array_filter($columns, fn ($col) => Schema::hasColumn('portfolio', $col)));
            if (!empty($existing)) {
                $table->dropColumn($existing);
            }
        });
    }
};


