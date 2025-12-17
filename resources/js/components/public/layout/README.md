# Layout Components Documentation

## Overview
This document explains the modular layout architecture for the PublicLayout component, following Vue 3 best practices and component separation.

## Architecture

### Before (Original)
- ❌ **543 lines** in a single file
- ❌ All layout sections in one component
- ❌ Mixed concerns (AppBar, Footer, Drawer, WhatsApp)
- ❌ Hard to maintain and test individual sections
- ❌ Not reusable components

### After (Refactored)
- ✅ **Modular** - Split into multiple focused components
- ✅ **Separated concerns** - Each section in its own file
- ✅ **Reusable components** - Can be used independently
- ✅ **Easier maintenance** - Changes isolated to specific components
- ✅ **Better organization** - Similar to products folder structure

## File Structure

```
resources/js/components/public/
├── PublicLayout.vue              # Main layout orchestrator (~127 lines)
└── layout/
    ├── AppBar.vue                 # Top navigation bar
    ├── MobileDrawer.vue           # Mobile navigation drawer
    ├── Footer.vue                 # Footer section
    ├── WhatsAppFloat.vue          # Floating WhatsApp button
    └── README.md                  # This file
```

## Components

### 1. PublicLayout.vue (Main)
**Lines: ~127** (down from 543)

**Responsibilities:**
- Overall layout orchestration
- Data management (settings, menu items)
- API calls for settings
- Scroll handling
- Component composition

**Key Features:**
- Imports and composes all layout components
- Manages shared state (siteName, settings, menuItems)
- Handles scroll events for AppBar styling
- Loads settings from API

### 2. AppBar.vue
**Lines: ~200**

**Responsibilities:**
- Top navigation bar
- Logo display
- Desktop navigation menu
- CTA button
- Mobile menu toggle button
- Scroll-based styling

**Props:**
- `isScrolled` (Boolean) - Whether page is scrolled
- `siteName` (String) - Site name for logo
- `siteTagline` (String) - Site tagline
- `menuItems` (Array) - Navigation menu items

**Events:**
- `toggle-drawer` - Emitted when mobile menu button is clicked

**Styles:**
- Transparent background when at top
- Blurred background when scrolled
- Hover effects on logo and navigation links
- Gradient border on scroll

### 3. MobileDrawer.vue
**Lines: ~70**

**Responsibilities:**
- Mobile navigation drawer
- Navigation menu for mobile
- Close button
- CTA button in drawer

**Props:**
- `modelValue` (Boolean) - Drawer visibility (v-model)
- `siteName` (String) - Site name
- `menuItems` (Array) - Navigation menu items

**Events:**
- `update:modelValue` - For v-model binding

**Features:**
- Right-side drawer
- Temporary overlay
- Responsive navigation

### 4. Footer.vue
**Lines: ~250**

**Responsibilities:**
- Footer section
- About section with social links
- Quick links navigation
- Services links
- Newsletter subscription
- Copyright and legal links

**Props:**
- `siteName` (String) - Site name
- `footerDescription` (String) - Footer description text
- `menuItems` (Array) - Navigation menu items
- `settings` (Object) - Settings object with social media URLs

**Methods:**
- `hasSocialLink(platform)` - Check if social link exists

**Styles:**
- Dark background with patterns
- Gradient glow effects
- Hover animations on links
- Social media button styles

### 5. WhatsAppFloat.vue
**Lines: ~50**

**Responsibilities:**
- Floating WhatsApp button
- WhatsApp link generation

**Props:**
- `whatsappUrl` (String) - WhatsApp URL (empty string hides button)

**Features:**
- Fixed position bottom-right
- Pulse animation
- Hover effects
- Only shows if URL is provided

## Benefits of Refactoring

### 1. **Maintainability**
- Each component has a single responsibility
- Easy to locate and fix bugs
- Changes don't affect unrelated functionality
- Smaller files are easier to understand

### 2. **Reusability**
- Components can be used in other layouts
- AppBar can be reused in admin layouts
- Footer can be customized per page if needed

### 3. **Testability**
- Components can be tested in isolation
- Easier to mock props and test behavior
- Better unit test coverage

### 4. **Developer Experience**
- Cleaner, more readable code
- Better IDE support with smaller files
- Easier onboarding for new developers
- Clear separation of concerns

### 5. **Performance**
- Better component isolation
- Optimized re-renders
- Smaller bundle chunks possible

### 6. **Scalability**
- Easy to add new layout components
- Can split further if needed
- Better for large teams

## Usage Example

```vue
<template>
    <v-app>
        <AppBar 
            :is-scrolled="isScrolled" 
            :site-name="siteName" 
            :site-tagline="siteTagline"
            :menu-items="menuItems" 
            @toggle-drawer="drawer = !drawer" 
        />

        <MobileDrawer 
            v-model="drawer" 
            :site-name="siteName" 
            :menu-items="menuItems" 
        />

        <v-main>
            <router-view />
        </v-main>

        <Footer 
            :site-name="siteName" 
            :footer-description="footerDescription" 
            :menu-items="menuItems"
            :settings="settings" 
        />

        <WhatsAppFloat :whatsapp-url="whatsappUrl" />
    </v-app>
</template>

<script>
import AppBar from './layout/AppBar.vue';
import MobileDrawer from './layout/MobileDrawer.vue';
import Footer from './layout/Footer.vue';
import WhatsAppFloat from './layout/WhatsAppFloat.vue';

export default {
    components: {
        AppBar,
        MobileDrawer,
        Footer,
        WhatsAppFloat
    },
    // ... component logic
};
</script>
```

## Migration Notes

### Component Communication
- **Props down**: Data flows from parent (PublicLayout) to children
- **Events up**: User interactions emit events to parent
- **v-model**: Used for MobileDrawer visibility

### Shared Data
- Site name, tagline, and menu items are managed in PublicLayout
- Settings are loaded once and passed to Footer
- Scroll state is managed in PublicLayout and passed to AppBar

### Styling
- Each component has its own scoped styles
- No global style conflicts
- Consistent design system maintained

## Future Enhancements

### Possible Additions:
1. **AppBar variants** - Different styles for different pages
2. **Footer customization** - Per-page footer content
3. **Theme support** - Dark/light mode toggle
4. **Accessibility improvements** - ARIA labels, keyboard navigation
5. **Animation options** - Configurable transitions
6. **Multi-language support** - i18n integration
7. **Analytics integration** - Track navigation clicks
8. **SEO optimization** - Meta tags management

## Troubleshooting

### Issue: Components not rendering
**Solution:** Ensure all imports are correct and files exist in the layout folder

### Issue: Props not updating
**Solution:** Check that props are properly bound with `:` syntax

### Issue: Events not firing
**Solution:** Verify event names match between emit and listener

### Issue: Styles not applying
**Solution:** Check that scoped styles are correct and no CSS conflicts exist

## Contributing

When modifying layout components:
1. Keep components focused and small
2. Maintain consistent prop naming
3. Document new props and events
4. Follow existing patterns
5. Test responsive behavior
6. Update this README if structure changes

---

**Last Updated:** December 2024  
**Version:** 2.0  
**Structure:** Modular Components

