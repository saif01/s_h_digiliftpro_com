/**
 * Format currency value
 * @param {number|string} value - Value to format
 * @param {string} currency - Currency symbol (default: $)
 * @returns {string} Formatted currency string
 */
export function formatCurrency(value, currency = '$') {
    if (!value) return `${currency}0.00`;
    const numValue = parseFloat(value);
    if (isNaN(numValue)) return `${currency}0.00`;
    return `${currency}${numValue.toFixed(2)}`;
}

/**
 * Format date to readable string
 * @param {string|Date} date - Date to format
 * @returns {string} Formatted date string
 */
export function formatDate(date) {
    if (!date) return '';
    const d = new Date(date);
    if (isNaN(d.getTime())) return '';

    return new Intl.DateTimeFormat('en-US', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    }).format(d);
}

/**
 * Truncate text to specified length
 * @param {string} text - Text to truncate
 * @param {number} maxLength - Maximum length
 * @param {string} suffix - Suffix to add (default: ...)
 * @returns {string} Truncated text
 */
export function truncate(text, maxLength = 100, suffix = '...') {
    if (!text || text.length <= maxLength) return text || '';
    return text.substring(0, maxLength).trim() + suffix;
}

/**
 * Slugify text for URLs
 * @param {string} text - Text to slugify
 * @returns {string} Slugified text
 */
export function slugify(text) {
    return text
        .toString()
        .toLowerCase()
        .trim()
        .replace(/\s+/g, '-')
        .replace(/[^\w\-]+/g, '')
        .replace(/\-\-+/g, '-');
}

/**
 * Get file size in human readable format
 * @param {number} bytes - File size in bytes
 * @returns {string} Formatted file size
 */
export function formatFileSize(bytes) {
    if (bytes === 0) return '0 Bytes';
    const k = 1024;
    const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));
    return Math.round(bytes / Math.pow(k, i) * 100) / 100 + ' ' + sizes[i];
}

/**
 * Capitalize first letter of string
 * @param {string} text - Text to capitalize
 * @returns {string} Capitalized text
 */
export function capitalize(text) {
    if (!text) return '';
    return text.charAt(0).toUpperCase() + text.slice(1);
}

/**
 * Convert snake_case to Title Case
 * @param {string} text - Text to convert
 * @returns {string} Title case text
 */
export function toTitleCase(text) {
    if (!text) return '';
    return text
        .replace(/_/g, ' ')
        .replace(/\w\S*/g, (txt) => txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase());
}

/**
 * Format number with thousand separators
 * @param {number|string} value - Value to format
 * @returns {string|null} Formatted number string or null if invalid
 */
export function formatNumber(value) {
    if (value === null || value === undefined || value === '') return null;
    const num = parseFloat(value);
    if (isNaN(num)) return null;
    // Allow 0 to be displayed
    return num.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 });
}

/**
 * Format product price in Bangladeshi Taka (Tk)
 * @param {Object} product - Product object with price or price_range
 * @param {number|string|null} product.price - Product price
 * @param {string|null} product.price_range - Product price range
 * @param {string} fallback - Fallback text when no price (default: 'Contact for Price')
 * @returns {string} Formatted price string
 */
export function formatProductPrice(product, fallback = 'Contact for Price') {
    if (!product) return fallback;

    // Prefer explicit price when available
    if (product.price !== null && product.price !== undefined && product.price !== '') {
        const formatted = formatNumber(product.price);
        if (formatted !== null) {
            return `Tk ${formatted}`;
        }
        // If formatNumber returns null but price exists, try to display it anyway
        const num = parseFloat(product.price);
        if (!isNaN(num)) {
            return `Tk ${num.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 })}`;
        }
    }

    // Fallback to price_range text when price is missing
    if (product.price_range) {
        // Replace $ with Tk if present
        return product.price_range.replace(/\$/g, 'Tk ');
    }

    return fallback;
}

/**
 * Format a single price value in Bangladeshi Taka (Tk)
 * @param {number|string|null} price - Price value to format
 * @param {string} fallback - Fallback text when no price (default: '-')
 * @returns {string} Formatted price string
 */
export function formatPrice(price, fallback = '-') {
    if (price === null || price === undefined || price === '') return fallback;

    const formatted = formatNumber(price);
    if (formatted !== null) {
        return `Tk ${formatted}`;
    }

    // If formatNumber returns null but price exists, try to display it anyway
    const num = parseFloat(price);
    if (!isNaN(num)) {
        return `Tk ${num.toLocaleString('en-US', { minimumFractionDigits: 0, maximumFractionDigits: 2 })}`;
    }

    return fallback;
}

/**
 * Format price range string (replaces $ with Tk)
 * @param {string|null} priceRange - Price range string
 * @param {string} fallback - Fallback text when no price range (default: '-')
 * @returns {string} Formatted price range string
 */
export function formatPriceRange(priceRange, fallback = '-') {
    if (!priceRange) return fallback;
    // Replace $ with Tk if present
    return priceRange.replace(/\$/g, 'Tk ');
}



