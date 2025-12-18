# DigiLiftPro - Digital Business Services Platform

**Website:** [digiliftpro.com](http://digiliftpro.com)

A comprehensive digital services platform for building, managing, and growing digital businesses. DigiLiftPro provides websites, SEO, email services, and web asset management—delivered with clear planning, measurable results, and long-term support.

## 🎯 About DigiLiftPro

DigiLiftPro is a professional digital services company specializing in:

- **Website & Web App Development** - Fast, secure, modern websites and applications
- **SEO & Growth Optimization** - SEO that increases visibility and brings real traffic
- **Web Assets Management** - Domain, hosting, SSL, and infrastructure management
- **Email Service Management** - Business email setup and deliverability optimization
- **Maintenance & Support** - Ongoing updates, security, and performance monitoring

### Value Proposition

**"Build, Manage, and Grow Your Digital Business"**

We deliver digital solutions with:
- ✅ Transparent scope & timelines
- ✅ Production-ready code & secure setup
- ✅ Documentation + handover training
- ✅ Dedicated support plans

## 🛠️ Technical Specifications

### Backend Stack

#### Core Framework
- **Laravel Framework**: ^12.0
- **PHP**: ^8.2
- **Composer**: Dependency management

#### Authentication & Security
- **Laravel Sanctum**: ^4.2 - API token-based authentication
- **Laravel UI**: ^4.6 - Authentication scaffolding

#### Database & ORM
- **Laravel Eloquent ORM**: Built-in ORM for database operations
- **MySQL/PostgreSQL/SQLite**: Supported database systems
- **Yajra Laravel DataTables**: ^12.3 - Advanced data tables with server-side processing
- **Yajra Laravel OCI8**: ^12.0 - Oracle database support

#### File Processing & Media
- **Intervention Image**: ^3.11 - Image manipulation library
- **Intervention Image Laravel**: ^1.5 - Laravel integration for image processing
- **Barryvdh Laravel Snappy**: ^1.0 - PDF generation from HTML

#### Data Export & Import
- **Maatwebsite Excel**: ^3.1 - Excel file import/export functionality

#### API & Integration
- **Guzzle HTTP**: ^7.9 - HTTP client for API requests
- **Inertia.js Laravel**: ^2.0 - Modern monolith approach (SPA-like experience)
- **Tightenco Ziggy**: ^2.4 - Route helper for JavaScript

#### Utilities
- **SimpleSoftwareIO Simple QRCode**: ^4.2 - QR code generation
- **Irazasyed Telegram Bot SDK**: ^3.15 - Telegram bot integration
- **DirectoryTree LDAPRecord Laravel**: ^3.4 - LDAP authentication support

#### Development Tools
- **Laravel Tinker**: ^2.10.1 - REPL for Laravel
- **Laravel Pint**: ^1.18 - Code style fixer
- **Laravel Sail**: ^1.41 - Docker development environment
- **Laravel Pail**: ^1.2.2 - Real-time log viewer
- **OpcodesIO Log Viewer**: ^3.17 - Advanced log viewing interface

#### Testing
- **PHPUnit**: ^11.5.3 - Unit testing framework
- **Mockery**: ^1.6 - Mocking library for testing
- **Nunomaduro Collision**: ^8.6 - Error handler for console/CLI
- **FakerPHP Faker**: ^1.23 - Fake data generator for testing

### Frontend Stack

#### Core Framework
- **Vue.js**: ^3.2.37 - Progressive JavaScript framework
- **Vue Router**: ^4.3.0 - Official router for Vue.js
- **Vite**: ^6.3.5 - Next-generation frontend build tool

#### UI Framework
- **Vuetify**: ^3.5.14 - Material Design component framework
- **Material Design Icons**: ^7.4.47 - Icon library (@mdi/font)

#### Design System & Brand Colors
- **CSS Custom Properties**: Centralized color management system
- **Brand Color Palette**:
  - Primary Purple: `#7c3aed` (with light and dark variants)
  - Accent Blue: `#3b82f6`
  - Accent Cyan: `#06b6d4`
  - Dark Theme: Deep navy to dark purple-blue gradients
- **Design Patterns**:
  - Glassmorphism with backdrop blur effects
  - Animated gradient backgrounds
  - Floating elements with hover animations
  - Modern card designs with shadows and glows
  - Responsive grid layouts
- **Typography**:
  - Primary Font: 'Nunito', sans-serif
  - Font weights: 400, 500, 600, 700, 800 (black)
  - Text shadows for depth and readability

#### State Management
- **Pinia**: ^3.0.4 - Official state management for Vue 3
- **Vuex**: ^4.1.0 - State management pattern library

#### Forms & Validation
- **VForm**: ^2.1.2 - Form validation library for Vue.js

#### Rich Text Editing
- **Quill**: ^2.0.3 - Rich text WYSIWYG editor
- **Vue3 Editor**: ^0.1.1 - Vue 3 wrapper for Quill

#### Data Visualization
- **Chart.js**: ^4.5.1 - Simple yet flexible JavaScript charting library
- **Vue ChartJS**: ^5.3.3 - Vue.js wrapper for Chart.js

#### UI Enhancements
- **Vue SweetAlert2**: ^5.0.5 - Beautiful, responsive, customizable popup boxes
- **Vue3 Progress Bar**: ^1.0.3 - Progress bar component for Vue 3

#### Utilities
- **Axios**: ^1.6.4 - Promise-based HTTP client
- **Moment.js**: ^2.30.1 - Date manipulation library
- **Bootstrap**: ^5.3.6 - CSS framework (for some legacy components)
- **Popper.js**: ^2.11.6 - Tooltip and popover positioning engine
- **Fontsource Prompt**: ^5.0.13 - Self-hosted Prompt font

#### Build Tools
- **Vite**: ^6.3.5 - Fast build tool and dev server
- **Sass**: ^1.89.1 - CSS preprocessor
- **Laravel Vite Plugin**: ^1.0 - Laravel integration for Vite
- **@vitejs/plugin-vue**: ^5.2.4 - Vue.js plugin for Vite

### Development Environment

#### Required Software
- **PHP**: 8.2 or higher
- **Composer**: PHP dependency manager
- **Node.js**: 18+ (for npm)
- **npm**: Package manager for JavaScript
- **MySQL/PostgreSQL/SQLite**: Database system

#### Build Commands
```bash
# Install PHP dependencies
composer install

# Install JavaScript dependencies
npm install

# Development build (with hot reload)
npm run dev

# Production build
npm run build
```

### Architecture

#### Backend Architecture
- **MVC Pattern**: Model-View-Controller architecture
- **RESTful API**: RESTful API design for admin panel
- **Service Layer**: Business logic separation
- **Repository Pattern**: Data access abstraction (where applicable)

#### Frontend Architecture
- **Component-Based**: Vue.js component architecture with scoped styles
- **SPA (Single Page Application)**: Client-side routing with Vue Router
- **API-Driven**: Frontend communicates with backend via REST API
- **State Management**: Centralized state with Pinia/Vuex
- **CSS Architecture**:
  - SCSS preprocessor with variables and mixins
  - CSS Custom Properties for dynamic theming
  - Scoped component styles with BEM-like naming
  - Utility classes from Vuetify and Bootstrap
  - Responsive breakpoints: 600px (mobile), 960px (tablet), 1280px (desktop)

#### Security Features
- **CSRF Protection**: Laravel's built-in CSRF protection
- **XSS Protection**: Automatic output escaping
- **SQL Injection Protection**: Eloquent ORM parameter binding
- **Authentication**: Laravel Sanctum token-based authentication
- **Authorization**: Role-Based Access Control (RBAC) with permissions

### Performance Optimizations

#### Backend
- **Query Optimization**: Eloquent eager loading
- **Caching**: Laravel's caching system
- **Database Indexing**: Optimized database queries
- **File Compression**: Image optimization with Intervention Image

#### Frontend
- **Code Splitting**: Lazy loading of routes and components
- **Asset Optimization**: Vite's built-in optimization
- **Image Lazy Loading**: Lazy loading for images
- **Tree Shaking**: Unused code elimination
- **CSS Optimizations**:
  - Critical CSS inlining
  - CSS minification
  - Autoprefixer for browser compatibility
  - Scoped styles to prevent CSS conflicts
  - CSS custom properties for dynamic theming

### Browser Support
- **Modern Browsers**: Chrome, Firefox, Safari, Edge (latest versions)
- **Mobile Browsers**: iOS Safari, Chrome Mobile
- **Responsive Design**: Mobile-first approach with Vuetify

### Design System & UI/UX Features

#### Visual Design Elements
- **Glassmorphism**: Modern frosted glass effects with backdrop blur
- **Gradient Backgrounds**: Animated multi-color gradients with brand colors
- **Floating Elements**: Cards and stats with floating animations
- **Hover Effects**: Scale, translate, and glow effects on interaction
- **Pulse Animations**: Icon pulse rings and glow effects
- **Gradient Borders**: Animated gradient borders on hover
- **Text Shadows**: Enhanced readability on dark backgrounds

#### Interactive Components
- **Why Choose Us Section**:
  - 4 glassmorphism feature cards
  - 3 floating stats cards (Projects, Support, Quality)
  - Animated background shapes
  - Gradient text effects
  - Icon glow and pulse animations
  - Responsive layout (side-by-side to stacked)
  
#### Accessibility
- **Text Contrast**: High contrast text (90%+ opacity) on dark backgrounds
- **Text Shadows**: Added shadows for better legibility
- **Font Weights**: Bold fonts (700) for important text
- **Interactive States**: Clear hover, focus, and active states
- **Responsive Typography**: Scaled text sizes for mobile devices

## 📋 Site Navigation

The public website includes the following main navigation:

- **Home** - Homepage with hero section, featured projects, services, testimonials, and CTA
- **Services** - Complete listing of all services (Website Development, SEO, Web Assets Management, Email Services, Maintenance & Support)
- **Products & Projects** - Portfolio of completed projects with detailed specifications and case studies
- **Case Studies** - Detailed case studies showcasing problem-solving approach and results
- **Pricing** - Transparent pricing packages (Starter, Business, Pro, Custom)
- **About** - Company story, mission, values, team, and development process
- **Contact** - Contact form with service selection, budget, and inquiry details

## 🚀 Features

### Core Features

#### Authentication & Security
- **Laravel Sanctum Authentication**: Secure API token-based authentication for admin panel
- **Role-Based Access Control (RBAC)**: Granular permission system with roles and permissions
- **User Management**: Complete user administration with:
  - Multiple role assignment per user
  - Profile information (phone, address, bio, etc.)
  - Avatar management
- **Permission Management**: Fine-grained permission control for all features
- **Login Logging**: Track all login attempts (successful and failed) with IP addresses and user agents
- **Visitor Logging**: Comprehensive visitor tracking with device, browser, OS, and bot detection

#### Settings Management
- **General Settings**: Site name (digiliftpro), tagline ("Build, Manage, and Grow Your Digital Business"), contact information, address
- **Home Page Settings**: Modular section management with tabbed interface:
  - Hero section with title ("Build, Manage, and Grow Your Digital Business"), subtitle, and CTA buttons ("Request a Quote", "View Our Projects")
  - Quick Highlights section with 3-6 feature cards (Website Development, SEO, Email Services, Asset Management, Maintenance, Analytics)
  - Statistics section with up to 4 customizable stat cards
  - Featured Projects section ("Our Recent Work") with 3-6 project cards
  - Why Choose Us section with modern glassmorphism design (Clear Planning & Timelines, Production-Ready & Secure, Dedicated Support Plans, Full-Stack Expertise) - includes animated backgrounds, floating stats cards, and brand color integration
  - Trusted By section with dynamic client logo management
  - Services section (WHAT WE DO) with dynamic service cards
  - Testimonials section with testimonial cards (optional)
  - CTA (Call-to-Action) section with text ("Have a project in mind? Let's turn your idea into a fast, secure, and scalable solution.") and button ("Book a Free Consultation")
  - Section visibility toggles for each section
- **Contact Page Settings**: Contact form configuration and page content
- **Branding Settings**: Logo, favicon, and color scheme customization
- **Social Media Settings**: Social media links and integration
- **SEO Settings**: Default meta tags, descriptions, and keywords
- **Email/SMTP Settings**: Email configuration for notifications

#### Leads & Communication
- **Lead Management**: Complete lead tracking system with:
  - Lead status management (New, Contacted, Qualified, Converted, Lost)
  - Lead type categorization (Contact, Quote, Support)
  - Read/Unread status tracking
  - Lead assignment to users
  - Notes and comments
  - CSV export functionality
- **Newsletter Subscriptions**: Newsletter management with:
  - Subscription status tracking
  - Email verification
  - CSV export functionality
  - Bulk operations

#### About Page Management
- **Singleton About Page**: Single about page management with:
  - Company story and description
  - Mission and vision
  - Team information
  - Company values

### Admin Panel Features

#### Dashboard & Analytics
- **AI-Powered Analytics Dashboard**: Comprehensive dashboard with:
  - **Statistics Cards**: 
    - Total Visitors with trend indicators
    - Human Visits with percentage breakdown
    - New Leads with attention alerts
    - Total Products with services count
  - **Interactive Charts** (Chart.js):
    - Visitor Trends: Line chart showing total and human visits over time
    - Device Distribution: Doughnut chart for desktop, mobile, tablet breakdown
    - Browser Distribution: Bar chart showing top browsers
    - Login Activity: Pie chart for successful vs failed logins
    - Leads by Status: Bar chart showing lead status distribution
    - Top Visited Pages: Horizontal bar chart for most visited URLs
  - **Time Range Selection**: Filter data by 7 days, 30 days, 90 days, or 1 year
  - **AI-Powered Insights**: Automated analysis providing:
    - Warnings for high bot traffic, login failures, new leads requiring attention
    - Success messages for strong engagement
    - Information about content portfolio
  - **Recent Activity**: Latest leads table with unread indicators
  - **Real-time Data**: All statistics update dynamically from database

#### Services Management
- **Service CRUD**: Complete service management with:
  - Title, slug, and descriptions
  - Icon selection (Material Design Icons)
  - Image upload with preview
  - Price range display
  - Features and benefits management
  - SEO optimization
  - Published/Draft status
  - Display order management
- **Service Details View**: Read-only view of complete service information
- **Rich Text Editor**: WYSIWYG editor for service descriptions

#### Products Management
- **Comprehensive Product Management**: 11-tab form system:
  1. **Basic Info**: Title, slug, SKU, brand, short description, full description
  2. **Media**: Thumbnail and gallery images with preview and upload
  3. **Pricing**: Price, discount percentage, discounted price, price range, show/hide price toggle
  4. **Categories & Tags**: Multi-select with auto-creation support
  5. **Specifications**: Dynamic key-value pairs for technical specs
  6. **Features**: Key features list with descriptions
  7. **Downloads**: File uploads (PDFs, datasheets, manuals) with preview
  8. **FAQs**: Question-answer pairs for customer support
  9. **Warranty & Service**: Warranty information and service details
  10. **SEO**: Meta title, description, keywords, OG image
  11. **Settings**: Published status, featured flag, stock management, availability status, display order
- **Product Details View**: Complete read-only view of all product information
- **Image Management**: 
  - Thumbnail upload with preview
  - Gallery images with drag-and-drop reordering
  - Image deletion
  - Automatic path normalization
- **File Management**: 
  - Downloadable files (PDFs, ZIPs, etc.)
  - File type detection
  - File size display
  - Preview before upload
- **Product Review Management**:
  - Comprehensive review moderation system
  - Review listing with filtering by status (pending, approved, rejected)
  - Search by product name, reviewer name, email, or comment
  - Sorting by date, rating, helpful count
  - Quick actions: Approve, Reject, Edit, Delete
  - Bulk status updates
  - Review statistics dashboard
  - Automatic product rating calculation from approved reviews
  - Rating distribution visualization
  - Verified purchase badges
  - Helpful/Not Helpful voting system
  - Admin notes and moderation tracking

#### Categories Management
- **Hierarchical Categories**: 
  - Parent-child relationships
  - Category type filtering (product, service, etc.)
  - Category icons and images
  - Published/Draft status
  - Display order
  - SEO optimization

#### Tags Management
- **Tag System**: 
  - Tag creation and management
  - Tag type filtering
  - Slug auto-generation
  - Tag usage tracking

#### Blog Management
- **Blog Post Management**:
  - Complete CRUD operations for blog posts
  - Rich text editor for content
  - Featured image upload with preview
  - Excerpt management
  - Author assignment (automatic from authenticated user)
  - Category assignment (multiple categories per post)
  - Tag assignment (multiple tags per post)
  - Publication date scheduling
  - Draft/Published status
  - SEO optimization (meta title, description, keywords, OG image)
  - View counter tracking
  - Search and filter functionality
  - Sorting by title, date, views, published status
  - Pagination support
- **Blog Category Management**:
  - Category CRUD operations
  - Category type filtering (post type)
  - Hierarchical category support
  - Category description and images
  - Published/Draft status
  - Display order management
  - SEO optimization

#### Career Management
- **Career Posting Management**:
  - Complete CRUD operations for career listings
  - Job title, slug, and department management
  - Location and employment type (full-time, part-time, contract, internship, freelance)
  - Rich text editor for job description, responsibilities, requirements, and benefits
  - Application deadline management with automatic expiration checking
  - Published/Draft status control
  - Display order management
  - Search and filter functionality (by department, location, employment type, published status)
  - Sorting by title, department, location, order, deadline, created date
  - Pagination support
  - Application count tracking per career
- **Job Application Management**:
  - Complete application tracking system
  - Application status management (new, reviewed, shortlisted, rejected, hired)
  - Applicant information (name, email, phone with Bangladesh validation)
  - Cover letter management
  - Resume file upload and download (PDF, DOC, DOCX)
  - Application notes and comments
  - Search and filter functionality (by status, career, applicant name/email)
  - Sorting by name, email, status, application date
  - Application details view with notes editing
  - Statistics dashboard (total, by status, by career)
  - Resume file management with automatic cleanup on deletion

#### Announcement Management
- **Announcement CRUD**: Complete announcement management system with:
  - Multiple announcement types:
    - Company News
    - Offers / Promotions
    - Events
    - Holidays
    - Urgent Alerts
  - Multiple display types:
    - Slider Banner (horizontal banner display)
    - Popup (modal dialog - auto-opens on page load)
    - Sidebar Ticker (sidebar scrolling ticker)
    - Page Section (embedded page section)
  - Rich content management:
    - Title and slug (auto-generated from title)
    - Short description for listings
    - Full HTML content with rich text editor
    - Image upload with preview
    - Video support (direct upload or YouTube URL with automatic embed)
    - External link support with new tab option
  - Scheduling system:
    - Start date/time scheduling (when announcement becomes active)
    - End date/time scheduling (when announcement expires)
    - Automatic activation/deactivation based on schedule
    - Priority ordering (0-999, lower numbers = higher priority)
  - SEO optimization:
    - Auto-generated meta titles from announcement title
    - Auto-generated meta descriptions from short description
    - Auto-generated keywords extracted from content
    - Search engine preview (live preview of search results)
    - Character count indicators with color-coded validation
    - Open Graph image for social media sharing
  - Status management:
    - Active/Inactive toggle
    - Soft delete support
    - Search and filter by status and type
    - Sorting by priority, date, title
    - Pagination support
  - Public display features:
    - Automatic display as dismissible modal dialogs
    - Sequential display for multiple announcements
    - "Don't show again" option with localStorage tracking
    - Priority-based ordering
    - Responsive dialog sizing (minimum 80% width on desktop, 95% on mobile)
    - YouTube video embedding support
    - Image and video media support

#### User Management
- **User Administration**:
  - User creation and editing
  - Role assignment (multiple roles per user)
  - Avatar upload
  - Profile information management:
    - Phone number
    - Date of birth
    - Gender (male, female, other)
    - Address, city, state, country, postal code
    - Bio/description
  - Account status management
  - Password reset functionality

#### Role & Permission Management
- **Role Management**:
  - Role creation with permissions
  - Permission assignment
  - System role protection
  - Permission grouping
- **Permission Management**:
  - Permission creation
  - Slug auto-generation
  - Permission grouping by feature
  - Flat and grouped view modes

#### Logs Management
- **Login Logs**:
  - Track all login attempts
  - Filter by status (success/failed)
  - Search by email, IP, user agent
  - Statistics dashboard
  - Time-series data for trends
- **Visitor Logs**:
  - Comprehensive visitor tracking
  - Device type detection (Desktop, Mobile, Tablet)
  - Browser and OS detection
  - Bot detection and filtering
  - IP address tracking
  - URL tracking
  - Referer tracking
  - Statistics with device/browser/OS breakdown
  - Top visited pages
  - Time-series data for trends
  - Bulk delete functionality

### Public Website Features

#### Homepage
- **Dynamic Homepage**: Fully configurable homepage with:
  - **Hero Section**: 
    - Title: "Build, Manage, and Grow Your Digital Business"
    - Subtitle: "Websites, SEO, email services, and web asset management—delivered with clear planning, measurable results, and long-term support."
    - CTAs: "Request a Quote" and "View Our Projects"
  - **Quick Highlights** (3-6 feature cards):
    - ✅ Custom Website & Web App Development
    - ✅ SEO & Performance Optimization
    - ✅ Email Service Setup & Monitoring
    - ✅ Domain / Hosting / SSL Management
    - ✅ Ongoing Maintenance & Support
    - ✅ Analytics, Tracking & Reporting
  - **Featured Projects Section** ("Our Recent Work"):
    - 3-6 project cards with images, titles, summaries, tech stack tags, and "View Details" buttons
  - **Why Choose Us Section** (Modern Glassmorphism Design):
    - Clear Planning & Timelines - Transparent scope definition and realistic milestones
    - Production-Ready & Secure - Clean code with industry-standard security practices
    - Dedicated Support Plans - Ongoing maintenance and 24/7 technical support
    - Full-Stack Expertise - Complete digital infrastructure management
    - Animated gradient backgrounds with purple/blue brand colors
    - Glassmorphism effects with backdrop blur
    - Floating stats cards (500+ Projects, 24/7 Support, 100% Quality)
    - Modern hover animations and interactive elements
  - **Testimonials Section** (optional): Client feedback cards
  - **Statistics Section**: Animated counters for key metrics
  - **CTA Section**: 
    - Text: "Have a project in mind? Let's turn your idea into a fast, secure, and scalable solution."
    - Button: "Book a Free Consultation"
  - All sections can be toggled on/off from admin panel

#### Products & Projects Display
- **Products & Projects Listing Page**:
  - **Introduction**: "Products & Projects - Explore our developed software, websites, and platforms. Each project page includes full specifications, screenshots, features, and technology details."
  - **Advanced Filtering System**:
    - Category: Website / Web App / SEO / Email / Asset Management
    - Industry: Education / Retail / Manufacturing / Healthcare / NGO
    - Technology: Laravel / Vue / React / WordPress / Node
    - Status: Live / In Progress / Private Deployment
  - **Project Card Template**:
    - Project thumbnail image
    - Project name
    - Short description (1-2 lines)
    - Tags: Industry + Tech + Year
    - Action buttons: "View Details" | "Request Similar"
  - Category-based filtering with icon buttons
  - Real-time search across titles, descriptions, SKU, and specifications
  - Multiple sorting options (newest, price, name, featured)
  - Product cards with images, quick specs, and prices
  - Featured product badges
  - **Product Comparison Tool**: Compare up to 3 products side-by-side with:
    - Price comparison
    - Key specifications comparison
    - Technical differences
    - Recommended use-cases
    - Quick access to product details
  - Responsive grid layout
  - Sticky filter bar on scroll

- **Product/Project Detail Page** (Full Specifications):
  - **Project Title** with name
  - **Gallery Section**: Image slider showing:
    - Homepage screenshots
    - Dashboard views
    - Reports and analytics
    - Mobile responsive views
  - **Project Summary**: Business goal + delivered solution + results
  - **Project Specifications**:
    - Client/Company (optional)
    - Industry classification
    - Type: Website / Web App / System
    - Platform: Web / Mobile Responsive
    - Technology Stack (Frontend, Backend, Database)
    - Hosting: Shared/VPS/Cloud + environment details
    - Security: SSL, roles/permissions, backups
    - Integrations: Payment/SMS/API/Email
    - Pages/Modules list
    - Timeline information
    - Support plan details
  - **Key Features** (bullet list):
    - Role-based access control
    - Dynamic reports & export (PDF/Excel)
    - Admin dashboard with KPI charts
    - SEO-ready structure and performance optimization
    - Automated backups & uptime monitoring
  - **Screenshots + Notes**: Each screenshot with captions ("Booking module", "Analytics view", etc.)
  - **Results** (if available):
    - Load time improvements (from X to Y)
    - SEO improvements / traffic growth metrics
    - Automation reduces manual work
  - **CTA Section**: "Want a similar system?" with "Get a Proposal" button
  - Hero section with product overview
  - Product gallery with:
    - Main image with zoom functionality
    - Thumbnail navigation
    - Image zoom dialog for detailed viewing
  - Key features section with icons
  - Quick specifications sidebar
  - Tabbed content:
    - **Overview**: Detailed description and benefits
    - **Technical Specs**: Complete specifications table
    - **Features**: Detailed feature list
    - **Downloads**: Datasheets, manuals, documentation (PDF, ZIP, etc.)
    - **FAQs**: Expandable FAQ section
    - **Warranty & Service**: Warranty coverage and support information
    - **Reviews**: Product review and rating system
  - Related products section
  - Trust badges (Warranty, Delivery, Support)

- **Product Review & Rating System**:
  - **Public Review Submission** (No login required):
    - Guest users can submit reviews with name and email
    - Authenticated users automatically attributed
    - 5-star rating system with half-star support
    - Review title and detailed comment
    - All reviews start with "pending" status
    - Form validation and error handling
    - Success notifications after submission
  - **Review Display**:
    - Overall rating summary with star visualization
    - Total review count and average rating
    - Rating distribution bar chart (5-star to 1-star breakdown)
    - Percentage breakdown per rating level
    - Only approved reviews displayed to public
    - Pagination support for large review lists
    - Sorting options (Most Recent, Highest Rated, Lowest Rated, Most Helpful)
    - Filter by rating (All, 5-star, 4-star, etc.)
  - **Review Cards**:
    - Reviewer name and submission date
    - Star rating visualization
    - Review title and comment
    - Verified purchase badge (if applicable)
    - Helpful voting buttons (upvote/downvote)
    - Vote count display
    - Responsive card layout
  - **Rating Statistics**:
    - Average rating with decimal precision
    - Total review count
    - Rating distribution percentages
    - Visual progress bars for each rating level
    - Real-time updates after admin approval

#### Services Display
- **Services Listing Page**: Grid view of all published services organized by category
- **Service Detail Pages**: Complete service information with:
  
  **A) Website & Web App Development**
  - Description: "We build fast, secure, modern websites and applications."
  - Features:
    - Business websites, landing pages, portfolio sites
    - Admin panels, dashboards, CRM modules
    - E-commerce & custom order systems
    - API integration (payment, SMS, ERP/CRM, etc.)
  
  **B) SEO & Growth Optimization**
  - Description: "SEO that increases visibility and brings real traffic."
  - Features:
    - Technical SEO audit & fixes
    - On-page SEO (structure, content, schema)
    - Speed optimization (Core Web Vitals)
    - Keyword plan + monthly reporting
  
  **C) Web Assets Management**
  - Description: "We manage the critical assets that keep your business online."
  - Features:
    - Domain renewals & DNS configuration
    - Hosting/VPS monitoring and backups
    - SSL certificate setup and renewal
    - Security hardening + uptime monitoring
  
  **D) Email Service Management**
  - Description: "Reliable email delivery for your business."
  - Features:
    - Business email setup (Google Workspace / Microsoft 365 / cPanel)
    - SPF/DKIM/DMARC configuration
    - Deliverability monitoring & troubleshooting
    - Mailing list and transactional email setup (if needed)
  
  **E) Maintenance & Support**
  - Description: "Stay updated, secure, and stable."
  - Features:
    - Monthly maintenance packages
    - Bug fixes, version upgrades
    - Security patches & logs review
    - Performance monitoring

#### Blog System
- **Blog Listing Page**:
  - Modern hero section with animated gradient effects
  - Real-time search across post titles, excerpts, and content
  - Category-based filtering with sidebar navigation
  - Multiple sorting options (Latest, Oldest, Most Views, Title A-Z)
  - Pagination support with configurable items per page
  - Responsive card-based layout
  - Loading states and empty state handling
  - Category badges and tag display
  - Author information and view counters
  - Featured image support
- **Blog Detail Page**:
  - Hero section with featured image overlay
  - Full post content with rich HTML rendering
  - Breadcrumb navigation
  - Author information card
  - Social sharing (Facebook, Twitter, LinkedIn, Copy link)
  - Tags and categories display
  - Automatic view counter increment
  - Related posts placeholder
  - Styled content typography (headings, lists, blockquotes, code blocks)
  - Responsive image display
- **Blog Features**:
  - SEO-friendly URLs (slug-based)
  - Meta tags and Open Graph support
  - Category management
  - Tag system
  - Author attribution
  - Publication date management
  - Draft/Published status
  - View tracking

#### Career System
- **Career Listing Page**:
  - Modern hero section with animated gradient effects
  - Real-time search across job titles, departments, locations, and descriptions
  - Advanced filtering:
    - Department filter (dynamically populated from available careers)
    - Location filter (dynamically populated from available careers)
    - Employment type filter (full-time, part-time, contract, internship, freelance)
  - Active careers only (automatically filters out expired deadlines)
  - Responsive card-based layout with hover effects
  - Career cards displaying:
    - Job title and department badge
    - Location and employment type
    - Application deadline (if set)
    - Truncated job description
    - Quick view button
  - Pagination support
  - Loading states and empty state handling
  - Clear filters functionality
- **Career Detail Page**:
  - Hero section with job title and key information chips
  - Comprehensive job information display:
    - Full job description with rich HTML rendering
    - Detailed responsibilities section
    - Job requirements section
    - Benefits and perks section
  - **Job Application Form** (sidebar):
    - Full name field (required)
    - Email field with validation (required)
    - Phone field with Bangladesh phone number validation (optional)
    - Cover letter textarea
    - Resume upload (PDF, DOC, DOCX, max 5MB)
    - Application deadline display and validation
    - Active/inactive status checking
    - Form validation with user-friendly error messages
    - Success/error notifications using SweetAlert2
    - Automatic form reset on successful submission
  - Back to careers navigation
  - Responsive layout (details on left, form on right)
- **Career Features**:
  - SEO-friendly URLs (slug-based)
  - Automatic deadline expiration checking
  - Bangladesh phone number validation (supports local: 01707080401 and international: +8801707080401 formats)
  - Resume file management with secure uploads
  - Application tracking and status management
  - Only published and active careers shown to public
  - Application count per career

#### Announcements System
- **Dynamic Announcement Display**:
  - Automatic display of active announcements as modal dialogs on page load
  - Multiple announcement types with color-coded headers:
    - Company News (blue/primary)
    - Offers / Promotions (green/success)
    - Events (info blue)
    - Holidays (orange/warning)
    - Urgent Alerts (red/error)
  - Responsive dialog sizing:
    - Minimum 80% width on desktop screens
    - 95% width on mobile devices
    - Adapts to content (larger for media, smaller for text-only)
  - Sequential display for multiple announcements with pagination indicator
  - Dismissible with "Don't show again" option (stored in localStorage)
  - Priority-based ordering (lower priority numbers shown first)
  - Media support:
    - Image display with responsive sizing
    - YouTube video embedding (automatic URL detection and conversion)
    - Direct video file playback (MP4, WebM)
    - Image error handling (auto-hides broken images)
  - Content display:
    - Rich HTML content rendering
    - Short description display
    - External link support with "Learn More" button
    - Type badges and labels
  - User experience:
    - "Next" button to navigate through multiple announcements
    - "Skip All" option to close all dialogs
    - Smooth transitions between announcements
    - Auto-opens 500ms after page load for better UX

#### Case Studies Page
- **Case Study Structure**: Each case study includes:
  - Problem statement
  - Solution approach
  - Screenshots and visual documentation
  - Measurable results and metrics
  - Technology stack used
  - Client testimonials (if available)

#### Pricing Page
- **Simple & Clear Pricing Structure**:
  - **Starter Package** (Website): Basic website development package
  - **Business Package** (Website + SEO Basics): Includes website and SEO fundamentals
  - **Pro Package** (Web App + Assets + Support): Comprehensive package with web apps, asset management, and ongoing support
  - **Custom Quote Available**: For CRM/ERP/automation systems and enterprise solutions
- Each package displays features, pricing, and clear call-to-action buttons

#### About Page
- **Company Story**: Background and history of DigiLiftPro
- **Mission & Values**: Core mission and company values
- **Team Skills**: Expertise and capabilities of the team
- **Development Process**: Step-by-step process:
  - Discovery: Understanding client needs and requirements
  - Design: UI/UX design and wireframing
  - Build: Development and implementation
  - Test: Quality assurance and testing
  - Deploy: Launch and deployment
  - Support: Ongoing maintenance and support

#### Contact Page
- **Contact Form Fields**:
  - Name (required)
  - Company (optional)
  - Phone (required)
  - Email (required)
  - Service Needed (dropdown selection)
  - Budget (optional)
  - Details/Message (required)
- **Contact Information**:
  - WhatsApp integration (floating button)
  - Phone number display
  - Email address
  - Office location (optional)
- **Automatic Lead Creation**: Contact form submissions create leads in admin panel
- **Email Notifications**: Admin receives notification of new contact form submissions

#### Newsletter Subscription
- Footer subscription form with email verification
- Email collection for marketing campaigns
- Subscription status tracking in admin panel

#### SEO & Performance
- **SEO Optimization**:
  - Meta tags per page
  - Open Graph tags
  - Structured data
  - Sitemap generation
- **Performance**:
  - Image optimization
  - Lazy loading
  - Responsive images
  - Fast page loads

## 📋 Prerequisites

- PHP 8.2 or higher
- Composer
- Node.js & npm
- MySQL/PostgreSQL/SQLite

## 🔧 Installation

### 1. Clone and Install Dependencies

```bash
git clone <repository-url>
cd s_h_micro_control
composer install
npm install
```

### 2. Environment Setup

```bash
cp .env.example .env
php artisan key:generate
```

Configure your `.env` file:
- Database connection
- `APP_URL`
- Mail settings (for notifications)

### 3. Database Setup

```bash
php artisan migrate
php artisan db:seed
```

This will create:
- All database tables
- Module definitions (disabled by default)
- 5 roles (Administrator, Content Manager, Marketing Manager, HR Manager, Support Staff)
- 5 demo users (one for each role) with profile information
- Demo content (products, services, blog posts, etc.)

### 4. Build Assets

```bash
npm run dev  # Development
# or
npm run build  # Production
```

### 5. Start Development Server

```bash
php artisan serve
npm run dev
```

Visit:
- Public website: `http://localhost:8000`
- Admin panel: `http://localhost:8000/admin/login`

## 🔑 Default User Credentials

The seeder creates demo users for all 5 roles. All users have the password: `password`

- **Administrator**: admin@mail.com
- **Content Manager**: content@mail.com
- **Marketing Manager**: marketing@mail.com
- **HR Manager**: hr@mail.com
- **Support Staff**: support@mail.com

⚠️ **Change these immediately in production!**

## 📚 API Documentation

### Admin API (`/api/v1/`)

All admin endpoints require authentication via Bearer token.

**Authentication:**
- `POST /api/v1/auth/login` - Login
- `POST /api/v1/auth/logout` - Logout
- `GET /api/v1/auth/user` - Get current user

**About Page Management:**
- `GET /api/v1/about` - Get about page (requires `manage-pages` permission)
- `POST /api/v1/about` - Create/update about page (requires `manage-pages` permission)
- `PUT /api/v1/about` - Update about page (requires `manage-pages` permission)

**Blog Management:**
- `GET /api/v1/blog-posts` - List blog posts (with pagination, filtering, sorting, search) (requires `manage-pages` permission)
- `POST /api/v1/blog-posts` - Create blog post (requires `manage-pages` permission)
- `GET /api/v1/blog-posts/{id}` - Get blog post (by ID or slug) (requires `manage-pages` permission)
- `PUT /api/v1/blog-posts/{id}` - Update blog post (requires `manage-pages` permission)
- `DELETE /api/v1/blog-posts/{id}` - Delete blog post (requires `manage-pages` permission)
- `GET /api/v1/blog-categories` - List blog categories (requires `manage-pages` permission)
- `POST /api/v1/blog-categories` - Create blog category (requires `manage-pages` permission)
- `GET /api/v1/blog-categories/{id}` - Get blog category (requires `manage-pages` permission)
- `PUT /api/v1/blog-categories/{id}` - Update blog category (requires `manage-pages` permission)
- `DELETE /api/v1/blog-categories/{id}` - Delete blog category (requires `manage-pages` permission)

**Career Management:**
- `GET /api/v1/careers` - List careers (with pagination, filtering, sorting, search) (requires `manage-pages` permission)
- `POST /api/v1/careers` - Create career (requires `manage-pages` permission)
- `GET /api/v1/careers/{id}` - Get career (by ID or slug) (requires `manage-pages` permission)
- `PUT /api/v1/careers/{id}` - Update career (requires `manage-pages` permission)
- `DELETE /api/v1/careers/{id}` - Delete career (requires `manage-pages` permission)

**Job Application Management:**
- `GET /api/v1/job-applications` - List job applications (with pagination, filtering, sorting, search) (requires `view-leads` permission)
- `GET /api/v1/job-applications/{id}` - Get job application (requires `view-leads` permission)
- `PUT /api/v1/job-applications/{id}` - Update job application status/notes (requires `manage-leads` permission)
- `DELETE /api/v1/job-applications/{id}` - Delete job application (requires `manage-leads` permission)
- `GET /api/v1/job-applications/statistics` - Get application statistics (requires `view-leads` permission)

**Announcement Management:**
- `GET /api/v1/announcements` - List announcements (with pagination, filtering by status/type, sorting, search) (requires `manage-announcements` permission)
- `POST /api/v1/announcements` - Create announcement (requires `manage-announcements` permission)
- `GET /api/v1/announcements/{id}` - Get announcement (by ID or slug) (requires `manage-announcements` permission)
- `PUT /api/v1/announcements/{id}` - Update announcement (requires `manage-announcements` permission)
- `DELETE /api/v1/announcements/{id}` - Delete announcement (soft delete) (requires `manage-announcements` permission)
- `PUT /api/v1/announcements/{id}/toggle-status` - Toggle active/inactive status (requires `manage-announcements` permission)

**Services Management:**
- `GET /api/v1/services` - List services (with pagination, filtering, sorting)
- `POST /api/v1/services` - Create service (requires `manage-services` permission)
- `GET /api/v1/services/{id}` - Get service (by ID or slug)
- `PUT /api/v1/services/{id}` - Update service (requires `manage-services` permission)
- `DELETE /api/v1/services/{id}` - Delete service (requires `manage-services` permission)

**Product Management:**
- `GET /api/v1/products` - List products (with pagination, filtering, sorting, search)
- `POST /api/v1/products` - Create product (requires `manage-products` permission)
- `GET /api/v1/products/{id}` - Get product (by ID or slug, includes all relationships)
- `PUT /api/v1/products/{id}` - Update product (requires `manage-products` permission)
- `DELETE /api/v1/products/{id}` - Delete product (requires `manage-products` permission)

**Product Review Management (Admin):**
- `GET /api/v1/products/reviews/all` - List all reviews with filtering, sorting, search (requires `manage-products` permission)
- `PUT /api/v1/products/{product}/reviews/{review}/approve` - Approve review (requires `manage-products` permission)
- `PUT /api/v1/products/{product}/reviews/{review}/reject` - Reject review (requires `manage-products` permission)
- `PUT /api/v1/products/{product}/reviews/{review}` - Update review (requires `manage-products` permission)
- `DELETE /api/v1/products/{product}/reviews/{review}` - Delete review (requires `manage-products` permission)

**Category Management:**
- `GET /api/v1/categories` - List categories (supports filtering by type, parent_id, published)
- `POST /api/v1/categories` - Create category (requires `manage-products` permission)
- `GET /api/v1/categories/{id}` - Get category (by ID or slug)
- `PUT /api/v1/categories/{id}` - Update category (requires `manage-products` permission)
- `DELETE /api/v1/categories/{id}` - Delete category (requires `manage-products` permission)

**Tag Management:**
- `GET /api/v1/tags` - List tags (supports filtering by type, search)
- `POST /api/v1/tags` - Create tag (requires `manage-products` permission)
- `GET /api/v1/tags/{id}` - Get tag (by ID or slug)
- `PUT /api/v1/tags/{id}` - Update tag (requires `manage-products` permission)
- `DELETE /api/v1/tags/{id}` - Delete tag (requires `manage-products` permission)

**File Upload:**
- `POST /api/v1/upload/image` - Upload single image (requires authentication)
- `POST /api/v1/upload/images` - Upload multiple images (requires authentication)
- `POST /api/v1/upload/file` - Upload file (PDF, DOC, ZIP, etc.) (requires authentication)
- `DELETE /api/v1/upload/image` - Delete image (requires authentication)

**Leads Management:**
- `GET /api/v1/leads` - List leads (with pagination, filtering, sorting, search) (requires `view-leads` permission)
- `GET /api/v1/leads/statistics` - Get leads statistics with time-series data (requires `view-leads` permission)
- `GET /api/v1/leads/unread-count` - Get count of unread leads (requires `view-leads` permission)
- `GET /api/v1/leads/{id}` - Get lead details (requires `view-leads` permission)
- `POST /api/v1/leads/{id}/mark-as-read` - Mark lead as read (requires `view-leads` permission)
- `PUT /api/v1/leads/{id}` - Update lead (requires `manage-leads` permission)
- `DELETE /api/v1/leads/{id}` - Delete lead (requires `manage-leads` permission)
- `GET /api/v1/leads/export/csv` - Export leads to CSV (requires `export-leads` permission)

**Newsletter Subscriptions:**
- `GET /api/v1/newsletters` - List newsletter subscriptions (requires `view-leads` permission)
- `GET /api/v1/newsletters/{id}` - Get subscription details (requires `view-leads` permission)
- `PUT /api/v1/newsletters/{id}` - Update subscription status (requires `manage-leads` permission)
- `DELETE /api/v1/newsletters/{id}` - Delete subscription (requires `manage-leads` permission)
- `GET /api/v1/newsletters/export/csv` - Export subscriptions to CSV (requires `manage-leads` permission)

**User Management:**
- `GET /api/v1/users` - List users (requires `manage-users` permission)
- `POST /api/v1/users` - Create user with profile fields and role assignment (requires `manage-users` permission)
- `GET /api/v1/users/{id}` - Get user (requires `manage-users` permission)
- `PUT /api/v1/users/{id}` - Update user including profile fields and roles (requires `manage-users` permission)
- `DELETE /api/v1/users/{id}` - Delete user (requires `manage-users` permission)
- `GET /api/v1/users/roles` - Get available roles for assignment (requires `manage-users` permission)

**Role & Permission Management:**
- `GET /api/v1/roles` - List roles (requires `manage-roles` permission)
- `POST /api/v1/roles` - Create role (requires `manage-roles` permission)
- `PUT /api/v1/roles/{id}` - Update role (requires `manage-roles` permission)
- `PUT /api/v1/roles/{id}/permissions` - Sync role permissions (requires `manage-roles` permission)
- `DELETE /api/v1/roles/{id}` - Delete role (requires `manage-roles` permission)
- `GET /api/v1/permissions` - List permissions (requires `manage-roles` permission)
- `GET /api/v1/permissions/groups` - Get permission groups (requires `manage-roles` permission)
- `POST /api/v1/permissions` - Create permission (requires `manage-roles` permission)
- `PUT /api/v1/permissions/{id}` - Update permission (requires `manage-roles` permission)
- `DELETE /api/v1/permissions/{id}` - Delete permission (requires `manage-roles` permission)

**Logs & Analytics:**
- `GET /api/v1/login-logs` - List login logs (with pagination, filtering, sorting) (requires `view-login-logs` permission)
- `GET /api/v1/login-logs/statistics` - Get login statistics with time-series data (requires `view-login-logs` permission)
- `GET /api/v1/login-logs/{id}` - Get login log details (requires `view-login-logs` permission)
- `DELETE /api/v1/login-logs/{id}` - Delete login log (requires `view-login-logs` permission)
- `GET /api/v1/visitor-logs` - List visitor logs (with pagination, filtering, sorting, search) (requires `view-visitor-logs` permission)
- `GET /api/v1/visitor-logs/statistics` - Get visitor statistics with time-series data (requires `view-visitor-logs` permission)
- `GET /api/v1/visitor-logs/{id}` - Get visitor log details (requires `view-visitor-logs` permission)
- `DELETE /api/v1/visitor-logs/{id}` - Delete visitor log (requires `view-visitor-logs` permission)
- `POST /api/v1/visitor-logs/delete-multiple` - Delete multiple visitor logs (requires `view-visitor-logs` permission)

**Settings:**
- `GET /api/v1/settings` - Get all settings (requires authentication)
- `PUT /api/v1/settings` - Update settings (requires `manage-settings` permission)

### Public API (`/api/openapi/`)

- `GET /api/openapi/home` - Homepage data (includes home page settings and featured content)
- `GET /api/openapi/pages/{slug}` - Get page by slug (for public page viewing)
- `GET /api/openapi/services` - List published services
- `GET /api/openapi/services/{slug}` - Get service by slug
- `GET /api/openapi/products` - List published products (supports category filter, brand filter, availability filter, rating filter, search, sorting)
- `GET /api/openapi/products/{slug}` - Get product by slug (includes categories, tags, specifications, downloads, rating, review count)
- `GET /api/openapi/categories` - List categories (supports type filter, pagination)

**Product Reviews (Public):**
- `GET /api/openapi/products/{product}/reviews` - List approved reviews for a product (supports pagination, filtering by rating, sorting)
- `POST /api/openapi/products/{product}/reviews` - Submit a review (no authentication required, guest submissions allowed)
- `GET /api/openapi/products/{product}/reviews/stats` - Get review statistics (average rating, total count, rating distribution)
- `POST /api/openapi/products/{product}/reviews/{review}/helpful` - Mark review as helpful/not helpful (no authentication required)
- `GET /api/openapi/blog` - List published blog posts (supports search, category filter, tag filter, sorting, pagination)
- `GET /api/openapi/blog/{slug}` - Get blog post by slug (includes author, categories, tags, auto-increments views)
- `GET /api/openapi/blog/categories` - List published blog categories

**Career (Public):**
- `GET /api/openapi/careers` - List published and active careers (supports search, department, location, employment type filters, active_only flag, sorting, pagination, returns filter options)
- `GET /api/openapi/careers/{slug}` - Get career by slug (includes application count, active status check)
- `POST /api/openapi/careers/apply` - Submit job application (with resume upload, Bangladesh phone validation, deadline checking)

**Announcements (Public):**
- `GET /api/openapi/announcements` - Get active announcements (supports filtering by type, display_type, language, pagination, sorted by priority)
- `GET /api/openapi/announcements/{slug}` - Get announcement by slug (public view)

**General (Public):**
- `GET /api/openapi/about` - Get about page content
- `GET /api/openapi/settings` - Get public settings
- `POST /api/openapi/contact` - Submit contact form (creates lead)
- `POST /api/openapi/newsletter/subscribe` - Subscribe to newsletter

## 🎨 Module Configuration

Modules are stored in the `modules` table. To enable a module:

**Via Code:**
```php
Module::where('name', 'services')->update(['enabled' => true]);
```

**Via Database:**
```sql
UPDATE modules SET enabled = 1 WHERE name = 'services';
```

**Available Modules:**
- `services` - Services catalog
- `products` - Products catalog
- `portfolio` - Portfolio/Projects
- `blog` - Blog/News
- `faq` - FAQ
- `careers` - Careers & Recruitment
- `announcements` - Announcement Management (Company News, Offers, Events, Holidays, Urgent Alerts)
- `booking` - Appointment booking
- `events` - Events & Registrations
- `branches` - Multi-location/Branches
- `ecommerce` - E-commerce (future)
- `multilanguage` - Multi-language support (future)

## 📁 Project Structure

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── Api/              # Admin API controllers
│   │   │   ├── auth/
│   │   │   ├── about/
│   │   │   ├── announcements/
│   │   │   ├── blog/
│   │   │   ├── leads/
│   │   │   ├── NewsletterController.php
│   │   │   ├── logs/
│   │   │   ├── products/
│   │   │   ├── settings/
│   │   │   ├── upload/
│   │   │   └── users/
│   │   └── Public/            # Public website controllers
│   │       ├── pages/
│   │       ├── announcements/
│   │       ├── blog/
│   │       ├── NewsletterController.php
│   │       ├── products/
│   │       └── services/
│   └── Middleware/            # Authentication & authorization
├── Models/                    # Eloquent models

database/
├── migrations/               # Database migrations
└── seeders/                  # Database seeders

resources/
├── js/
│   ├── components/
│   │   ├── admin/            # Admin panel components
│   │   │   ├── auth/
│   │   │   ├── about/
│   │   │   ├── blog/
│   │   │   ├── leads/
│   │   │   ├── newsletters/
│   │   │   ├── logs/
│   │   │   ├── products/
│   │   │   ├── settings/
│   │   │   └── users/
│   │   └── public/           # Public website components
│   │       ├── pages/
│   │       ├── blog/
│   │       ├── products/
│   │       └── services/
│   ├── mixins/               # Vue mixins
│   ├── plugins/              # Vue plugins (Vuetify, SweetAlert, ProgressBar)
│   ├── routes.js             # Vue Router configuration
│   └── utils/                # Utility functions
└── sass/
    ├── _variables.scss       # Brand colors and SCSS variables
    └── app.scss              # Main stylesheet with CSS custom properties

routes/
├── api.php                   # API routes
└── web.php                   # Web routes (includes public API)

public/
└── uploads/                  # Uploaded files (images, documents)
    ├── products/
    └── ...
```

## 🔒 Security

- Admin routes protected with Laravel Sanctum
- Password hashing
- CSRF protection
- XSS protection
- SQL injection protection (Eloquent ORM)
- Role-based access control (RBAC)
- Permission-based route protection
- Bot detection and filtering
- IP address tracking for security

## 📝 Notes

- **DigiLiftPro Platform**: This platform is specifically designed for DigiLiftPro digital services business
- **Focus Areas**: Website development, SEO optimization, web asset management, email services, and ongoing support
- All core models and relationships are set up and configured
- Additional features can be added incrementally
- The platform is designed to be modular and configurable
- Products & Projects management includes comprehensive project showcase features
- File uploads are stored in `public/uploads/{folder}/` for easy access
- Dashboard includes AI-powered insights and real-time analytics
- All charts use Chart.js for modern, interactive visualizations
- Project showcase supports detailed specifications, technology stacks, and case studies
- Services are organized into 5 main categories (Website Development, SEO, Asset Management, Email Services, Maintenance)
- Contact form creates leads automatically for business inquiries
- Newsletter subscription for marketing campaigns and updates

## 🛠️ Development

### Adding a New Module

1. Create migration: `php artisan make:migration create_[module]_table`
2. Create model: `php artisan make:model [Module]`
3. Create controller: `php artisan make:controller Api/[Module]Controller --api`
4. Add to ModuleSeeder
5. Create Vue components
6. Update routes

### Testing

```bash
php artisan test
```

## 📄 License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.
