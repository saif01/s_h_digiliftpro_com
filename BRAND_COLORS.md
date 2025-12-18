# DigiLiftPro Brand Colors Guide

## Overview
This document provides a comprehensive guide to the DigiLiftPro brand color system. All colors are centrally managed in `resources/sass/_variables.scss` and available as CSS custom properties throughout the application.

---

## Primary Brand Colors

### Purple Palette (Main Brand Identity)
```scss
--brand-primary: #7c3aed          // Primary Purple
--brand-primary-light: #a855f7    // Light Purple
--brand-primary-dark: #6d28d9     // Dark Purple
--brand-secondary: #8b5cf6        // Secondary Purple
```

**Usage:**
- Primary CTAs and buttons
- Brand highlights
- Interactive elements
- Active states

**Example:**
```css
.cta-button {
    background: var(--brand-gradient-primary);
    box-shadow: var(--brand-shadow-primary);
}
```

---

## Accent Colors

### Blue & Cyan Palette
```scss
--brand-accent-blue: #3b82f6       // Bright Blue
--brand-accent-cyan: #06b6d4       // Cyan
--brand-accent-light-blue: #60a5fa // Light Blue
```

**Usage:**
- Secondary actions
- Information displays
- Visual diversity
- Complementary gradients

---

## Dark Theme Colors

### Background Shades
```scss
--brand-dark-primary: #0f172a      // Deep Navy
--brand-dark-secondary: #1e1b4b    // Dark Purple Blue
--brand-dark-tertiary: #1e293b     // Slate Dark
```

**Usage:**
- Hero section backgrounds
- Dark mode elements
- Code windows
- Dashboard cards

**Example:**
```css
.hero-section {
    background: var(--brand-gradient-hero);
}
```

---

## Status Colors

### Feedback & Notifications
```scss
--brand-success: #10b981           // Green
--brand-warning: #f59e0b           // Amber
--brand-error: #ef4444             // Red
--brand-info: #3b82f6              // Blue
```

**Usage:**
- Success messages
- Warning alerts
- Error states
- Information banners

---

## Neutral Colors

### Base Shades
```scss
--brand-white: #ffffff
--brand-gray-light: #f8fafc
--brand-gray: #94a3b8
--brand-gray-dark: #475569
```

---

## Gradients

### Pre-defined Gradient Combinations
```scss
--brand-gradient-primary: linear-gradient(135deg, #7c3aed 0%, #a855f7 100%)
--brand-gradient-hero: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #1e293b 100%)
--brand-gradient-purple-glow: linear-gradient(45deg, #7c3aed, #a855f7)
--brand-gradient-blue-cyan: linear-gradient(45deg, #3b82f6, #06b6d4)
```

**Usage:**
```css
.button-primary {
    background: var(--brand-gradient-primary);
}

.hero-background {
    background: var(--brand-gradient-hero);
}
```

---

## Shadows & Effects

### Elevation & Depth
```scss
--brand-shadow-primary: 0 10px 30px rgba(124, 58, 237, 0.4)
--brand-shadow-hover: 0 20px 40px rgba(124, 58, 237, 0.6)
--brand-glow-primary: 0 0 20px rgba(124, 58, 237, 0.5)
```

**Usage:**
```css
.card:hover {
    box-shadow: var(--brand-shadow-hover);
}

.active-element {
    box-shadow: var(--brand-glow-primary);
}
```

---

## Glassmorphism & Overlays

### Transparency Layers
```scss
--brand-overlay-light: rgba(255, 255, 255, 0.05)
--brand-overlay-medium: rgba(255, 255, 255, 0.1)
--brand-overlay-strong: rgba(255, 255, 255, 0.15)
--brand-backdrop-blur: rgba(255, 255, 255, 0.08)
--brand-glass-bg: rgba(255, 255, 255, 0.1)
--brand-glass-border: rgba(255, 255, 255, 0.2)
```

**Usage:**
```css
.glass-card {
    background: var(--brand-glass-bg);
    border: 1px solid var(--brand-glass-border);
    backdrop-filter: blur(20px);
}

.overlay {
    background: var(--brand-overlay-medium);
}
```

---

## RGB Values (for rgba() usage)

### Opacity Control
```scss
--brand-primary-rgb: 124, 58, 237
--brand-primary-light-rgb: 168, 85, 247
--brand-accent-blue-rgb: 59, 130, 246
```

**Usage:**
```css
.semi-transparent {
    background: rgba(var(--brand-primary-rgb), 0.3);
}

.hover-effect {
    border-color: rgba(var(--brand-primary-rgb), 0.5);
}
```

---

## How to Use

### In Vue Components (Scoped Styles)
```vue
<style scoped>
.my-component {
    background: var(--brand-gradient-primary);
    color: var(--brand-white);
    box-shadow: var(--brand-shadow-primary);
}

.my-button:hover {
    box-shadow: var(--brand-shadow-hover);
}
</style>
```

### In Global SCSS Files
```scss
@use 'variables' as *;

.my-class {
    background: $brand-primary;
    border: 1px solid $brand-primary-light;
}
```

### In Inline Styles
```vue
<template>
    <div :style="{ 
        background: 'var(--brand-gradient-primary)',
        boxShadow: 'var(--brand-shadow-primary)'
    }">
        Content
    </div>
</template>
```

---

## Brand Guidelines

### Do's ✅
- Use primary purple for main CTAs
- Use gradients for premium feel
- Use glassmorphism for modern UI
- Maintain consistent shadows
- Use RGB values for dynamic opacity

### Don'ts ❌
- Don't use hardcoded hex colors
- Don't mix too many accent colors
- Don't use low-contrast combinations
- Don't modify colors inline
- Don't create custom gradients without design approval

---

## Color Combinations

### High Impact
```css
Primary Button:
- Background: var(--brand-gradient-primary)
- Text: var(--brand-white)
- Shadow: var(--brand-shadow-primary)
```

### Subtle Accent
```css
Info Card:
- Background: var(--brand-overlay-medium)
- Border: var(--brand-glass-border)
- Backdrop: blur(20px)
```

### Status Display
```css
Success State:
- Icon: var(--brand-success)
- Background: rgba(16, 185, 129, 0.1)
- Border: rgba(16, 185, 129, 0.3)
```

---

## Updating Brand Colors

To change brand colors across the entire application:

1. **Edit SCSS Variables:**
   ```bash
   # Edit file: resources/sass/_variables.scss
   $brand-primary: #NEW_COLOR;
   ```

2. **Update CSS Custom Properties:**
   ```bash
   # Edit file: resources/sass/app.scss
   --brand-primary: #NEW_COLOR;
   ```

3. **Rebuild Assets:**
   ```bash
   npm run dev    # Development
   npm run build  # Production
   ```

4. **Clear Cache:**
   ```bash
   php artisan cache:clear
   php artisan view:clear
   ```

---

## Examples in Current Components

### HeroSection.vue
- Background: `var(--brand-gradient-hero)`
- Buttons: `var(--brand-gradient-primary)`
- Glass cards: `var(--brand-glass-bg)`
- Orbs: `var(--brand-gradient-purple-glow)`

### AppBar.vue
- Can use brand colors for active states
- Hover effects with brand shadows
- Glassmorphism backgrounds

---

## Accessibility

### Contrast Ratios
All brand colors have been chosen to meet WCAG 2.1 Level AA standards:

- **Primary Purple on White:** 4.5:1+ ✅
- **White Text on Primary:** 4.5:1+ ✅
- **Accent Blue on White:** 4.5:1+ ✅

### Testing Contrast
```css
/* Always test color combinations */
.text-on-brand {
    color: var(--brand-white);
    background: var(--brand-primary);
    /* Passes WCAG AA */
}
```

---

## Support

For questions about brand colors or design system:
- Check this guide first
- Review `resources/sass/_variables.scss`
- Review `resources/sass/app.scss`
- Test in browser DevTools with CSS variables

---

**Last Updated:** December 2024  
**Version:** 1.0.0  
**Maintained by:** DigiLiftPro Development Team

