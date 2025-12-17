# Public Blog Page Documentation

## Overview

The public blog section provides a complete blogging system for displaying blog posts to website visitors. It includes a blog listing page, individual post detail pages, and comprehensive filtering and search capabilities.

## Features

### Blog Listing Page (`BlogPage.vue`)

#### Core Features
- **Hero Section**: Eye-catching hero section with animated gradient orbs and glassmorphism effects
- **Search Functionality**: Real-time search across post titles, slugs, excerpts, and content
- **Category Filtering**: Filter posts by blog categories with sidebar navigation
- **Sorting Options**: 
  - Latest First (default)
  - Oldest First
  - Most Views
  - Title A-Z
- **Pagination**: Full pagination support with configurable items per page
- **Responsive Design**: Fully responsive layout that works on all device sizes
- **Loading States**: Skeleton loaders and progress indicators
- **Empty States**: User-friendly messages when no posts are found

#### Visual Features
- Modern card-based layout
- Hover effects and animations
- Category badges and tags
- Author information display
- View count indicators
- Featured image support
- Date formatting

### Blog Detail Page (`BlogDetailPage.vue`)

#### Core Features
- **Full Post Display**: Complete blog post content with HTML rendering
- **Hero Section**: Featured image hero with overlay
- **Breadcrumb Navigation**: Easy navigation back to blog listing
- **Author Information**: Author card with details
- **Social Sharing**: 
  - Facebook
  - Twitter
  - LinkedIn
  - Copy link to clipboard
- **Tags & Categories**: Display of post tags and categories
- **View Counter**: Automatic view increment on page load
- **Related Posts**: Placeholder for related posts section
- **Rich Content Rendering**: Full support for HTML content with styled headings, lists, images, blockquotes, and code blocks

#### Visual Features
- Responsive image display
- Styled content typography
- Code syntax highlighting support
- Image zoom capability
- Share button integration

### Blog Card Component (`BlogCard.vue`)

#### Features
- **Post Preview**: Displays post title, excerpt, and featured image
- **Metadata Display**: 
  - Publication date
  - View count
  - Author information
  - Categories
  - Tags
- **Hover Effects**: Smooth animations on card hover
- **Click Navigation**: Direct link to post detail page
- **Responsive Layout**: Adapts to different screen sizes

## Components Structure

```
resources/js/components/public/blog/
├── BlogPage.vue          # Main blog listing page
├── BlogDetailPage.vue    # Individual post detail page
├── BlogCard.vue          # Reusable post card component
└── README.md             # This documentation file
```

## API Endpoints

### Public Blog API (`/api/openapi/blog`)

#### List Blog Posts
```
GET /api/openapi/blog
```

**Query Parameters:**
- `page` (integer): Page number for pagination (default: 1)
- `per_page` (integer): Items per page (default: 12)
- `search` (string): Search query for filtering posts
- `category` (string): Filter by category slug
- `tag` (string): Filter by tag slug
- `author_id` (integer): Filter by author ID
- `sort_by` (string): Sort field - `published_at`, `views`, `created_at`, `title`
- `sort_direction` (string): Sort direction - `asc` or `desc`

**Response:**
```json
{
  "data": [
    {
      "id": 1,
      "title": "Post Title",
      "slug": "post-title",
      "excerpt": "Post excerpt...",
      "featured_image": "https://...",
      "published_at": "2024-01-01T00:00:00.000000Z",
      "views": 150,
      "author": {
        "id": 1,
        "name": "Author Name",
        "email": "author@example.com"
      },
      "categories": [...],
      "tags": [...]
    }
  ],
  "current_page": 1,
  "last_page": 5,
  "per_page": 12,
  "total": 50
}
```

#### Get Single Post
```
GET /api/openapi/blog/{slug}
```

**Response:**
```json
{
  "id": 1,
  "title": "Post Title",
  "slug": "post-title",
  "excerpt": "Post excerpt...",
  "content": "<p>Full post content...</p>",
  "featured_image": "https://...",
  "published_at": "2024-01-01T00:00:00.000000Z",
  "views": 151,
  "author": {...},
  "categories": [...],
  "tags": [...],
  "meta_title": "...",
  "meta_description": "...",
  "meta_keywords": "...",
  "og_image": "..."
}
```

**Note:** View count is automatically incremented when a post is viewed.

#### Get Blog Categories
```
GET /api/openapi/blog/categories
```

**Response:**
```json
[
  {
    "id": 1,
    "name": "Technology",
    "slug": "technology",
    "description": "Technology related posts",
    "image": "https://...",
    "order": 1
  }
]
```

## Frontend Routes

### Blog Listing
- **Route:** `/blog`
- **Component:** `BlogPage.vue`
- **Name:** `Blog`

### Blog Detail
- **Route:** `/blog/:slug`
- **Component:** `BlogDetailPage.vue`
- **Name:** `BlogDetail`

## Usage Examples

### Accessing Blog Listing
```javascript
// Navigate to blog listing
this.$router.push({ name: 'Blog' });
// or
this.$router.push('/blog');
```

### Accessing Blog Post
```javascript
// Navigate to specific post
this.$router.push({ 
  name: 'BlogDetail', 
  params: { slug: 'my-post-slug' } 
});
// or
this.$router.push('/blog/my-post-slug');
```

### Fetching Blog Posts Programmatically
```javascript
import axios from 'axios';

// Get all posts
const response = await axios.get('/api/openapi/blog', {
  params: {
    page: 1,
    per_page: 12,
    sort_by: 'published_at',
    sort_direction: 'desc'
  }
});

// Search posts
const searchResponse = await axios.get('/api/openapi/blog', {
  params: {
    search: 'search term',
    category: 'technology'
  }
});

// Get single post
const post = await axios.get('/api/openapi/blog/my-post-slug');

// Get categories
const categories = await axios.get('/api/openapi/blog/categories');
```

## Configuration

### Pagination
Default items per page: **12**

To change pagination:
```javascript
// In BlogPage.vue
const params = {
  page: currentPage.value,
  per_page: 24  // Change this value
};
```

### Sorting Options
Available sort options:
- `published_at` - Sort by publication date
- `views` - Sort by view count
- `created_at` - Sort by creation date
- `title` - Sort alphabetically

### Category Filtering
Categories are loaded from the database and filtered by:
- Type: `post`
- Published: `true` (if published column exists)

## Styling

### Custom CSS Classes

#### Blog Page
- `.blog-page-modern` - Main container
- `.page-hero` - Hero section
- `.gradient-orb` - Animated gradient orbs
- `.glass-pill` - Glassmorphism pill badge

#### Blog Card
- `.blog-card` - Card container
- `.blog-image-container` - Image wrapper
- `.image-overlay` - Image overlay gradient

#### Blog Detail
- `.blog-detail-page` - Main container
- `.blog-hero` - Hero section with image
- `.blog-content-card` - Content card
- `.blog-content` - Styled content area

### Content Styling

The blog content area includes automatic styling for:
- Headings (h1-h6)
- Paragraphs
- Lists (ul, ol)
- Blockquotes
- Code blocks
- Images

## Features Breakdown

### Search & Filter
- ✅ Real-time search
- ✅ Category filtering
- ✅ Tag filtering (API ready)
- ✅ Author filtering (API ready)
- ✅ Sort by multiple criteria
- ✅ Clear filters functionality

### Display Features
- ✅ Featured images
- ✅ Excerpt display
- ✅ Full content rendering
- ✅ Author information
- ✅ Publication dates
- ✅ View counters
- ✅ Category badges
- ✅ Tag chips

### User Experience
- ✅ Responsive design
- ✅ Loading states
- ✅ Error handling
- ✅ Empty states
- ✅ Pagination
- ✅ Breadcrumb navigation
- ✅ Social sharing
- ✅ Smooth animations

### SEO Features
- ✅ SEO-friendly URLs (slug-based)
- ✅ Meta tags support
- ✅ Open Graph image support
- ✅ Structured content

## Dependencies

### Backend
- Laravel Framework
- Eloquent ORM
- MediaPath helper for image URLs

### Frontend
- Vue 3
- Vuetify 3
- Axios
- Vue Router

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)
- Mobile browsers (iOS Safari, Chrome Mobile)

## Performance Considerations

1. **Pagination**: Posts are paginated to limit data transfer
2. **Image Optimization**: Images are served through MediaPath helper
3. **Lazy Loading**: Images can be lazy-loaded (implement as needed)
4. **Caching**: Consider implementing API response caching for better performance

## Future Enhancements

Potential features to add:
- [ ] Related posts functionality
- [ ] Post comments system
- [ ] Reading time estimation
- [ ] Print-friendly view
- [ ] Email sharing
- [ ] RSS feed
- [ ] Newsletter subscription from blog posts
- [ ] Advanced filtering (date range, multiple categories)
- [ ] Post preview mode
- [ ] Author profile pages
- [ ] Tag archive pages
- [ ] Category archive pages

## Troubleshooting

### Categories Not Loading
- Check if `categories` table has `type` column
- Verify `published` column exists (optional)
- Check Laravel logs for specific errors
- Ensure database connection is working

### Posts Not Displaying
- Verify posts are published (`published = true`)
- Check `published_at` is set and in the past
- Ensure API endpoint is accessible
- Check browser console for errors

### Images Not Showing
- Verify MediaPath helper is configured correctly
- Check image paths in database
- Ensure storage is properly linked
- Verify file permissions

## Support

For issues or questions:
1. Check Laravel logs: `storage/logs/laravel.log`
2. Check browser console for frontend errors
3. Verify API endpoints are accessible
4. Check database connectivity

## Version History

- **v1.0.0** (Initial Release)
  - Blog listing page
  - Blog detail page
  - Category filtering
  - Search functionality
  - Pagination
  - Social sharing

