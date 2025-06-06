class SeoManager {
    constructor(options = {}) {
        // Các giá trị mặc định hoặc được truyền vào khi khởi tạo
        this.pageTitle = options.pageTitle || document.title;
        this.metaDescriptionContent = options.metaDescriptionContent || '';
        this.metaKeywordsContent = options.metaKeywordsContent || '';
        this.ogImageContent = options.ogImageContent || '';
        this.ogUrlContent = options.ogUrlContent || window.location.href;
        this.ogType = options.ogType || 'website';
        this.ogSiteName = options.ogSiteName || '';
        this.canonicalHref = options.canonicalHref || window.location.href;
        // Thêm các thuộc tính cho Facebook nếu cần
        this.fbSite = "https://www.facebook.com/5SRService";

        // Tự động chạy khi khởi tạo đối tượng, nếu muốn
        if (options.autoUpdate !== false) { // Mặc định là true
            document.addEventListener('DOMContentLoaded', () => {
                this.updateAll();
            });
        }
    }

    // Phương thức để cập nhật tiêu đề trang
    updateTitle(newTitle) {
        if (newTitle !== undefined) this.pageTitle = newTitle;
        document.title = this.pageTitle;
        this.updateOrCreateMetaTag('property', 'og:title', this.pageTitle);
        this.updateOrCreateMetaTag('property', 'fb:title', this.pageTitle); // Cập nhật Facebook title
        return this; // Cho phép chaining
    }

    // Phương thức chung để cập nhật hoặc tạo thẻ meta
    updateOrCreateMetaTag(attributeType, attributeValue, content) {
        let selector = `meta[${attributeType}="${attributeValue}"]`;
        if (attributeType === 'rel') { // Dành cho thẻ link (canonical)
            selector = `link[rel="${attributeValue}"]`;
        }

        let tag = document.querySelector(selector);

        if (tag) {
            if (attributeType === 'rel') {
                tag.setAttribute('href', content);
            } else {
                tag.setAttribute('content', content);
            }
        } else {
            if (attributeType === 'rel') {
                tag = document.createElement('link');
                tag.setAttribute(attributeType, attributeValue);
                tag.setAttribute('href', content);
            } else {
                tag = document.createElement('meta');
                tag.setAttribute(attributeType, attributeValue);
                tag.setAttribute('content', content);
            }
            document.head.appendChild(tag);
        }
        return this; // Cho phép chaining
    }

    // Phương thức để cập nhật Meta Description
    updateMetaDescription(newDescription) {
        if (newDescription !== undefined) this.metaDescriptionContent = newDescription;
        this.updateOrCreateMetaTag('name', 'description', this.metaDescriptionContent);
        this.updateOrCreateMetaTag('property', 'og:description', this.metaDescriptionContent);
        this.updateOrCreateMetaTag('property', 'fb:description', this.metaDescriptionContent); // Cập nhật Facebook description
        return this;
    }

    // Phương thức để cập nhật Meta Keywords
    updateMetaKeywords(newKeywords) {
        if (newKeywords !== undefined) this.metaKeywordsContent = newKeywords;
        this.updateOrCreateMetaTag('name', 'keywords', this.metaKeywordsContent);
        return this;
    }

    // Phương thức để cập nhật Open Graph Image
    updateOgImage(newOgImage) {
        if (newOgImage !== undefined) this.ogImageContent = newOgImage;
        this.updateOrCreateMetaTag('property', 'og:image', this.ogImageContent);
        this.updateOrCreateMetaTag('property', 'fb:image', this.ogImageContent); // Cập nhật Facebook image
        return this;
    }

    // Phương thức để cập nhật Open Graph URL
    updateOgUrl(newOgUrl) {
        if (newOgUrl !== undefined) this.ogUrlContent = newOgUrl;
        this.updateOrCreateMetaTag('property', 'og:url', this.ogUrlContent);
        return this;
    }

    // Phương thức để cập nhật Open Graph Type
    updateOgType(newOgType) {
        if (newOgType !== undefined) this.ogType = newOgType;
        this.updateOrCreateMetaTag('property', 'og:type', this.ogType);
        return this;
    }

    // Phương thức để cập nhật Open Graph Site Name
    updateOgSiteName(newOgSiteName) {
        if (newOgSiteName !== undefined) this.ogSiteName = newOgSiteName;
        if (this.ogSiteName) { // Chỉ tạo/cập nhật nếu có giá trị
            this.updateOrCreateMetaTag('property', 'og:site_name', this.ogSiteName);
        }
        return this;
    }

    // Phương thức để cập nhật Thẻ Canonical
    updateCanonical(newCanonicalHref) {
        if (newCanonicalHref !== undefined) this.canonicalHref = newCanonicalHref;
        this.updateOrCreateMetaTag('rel', 'canonical', this.canonicalHref);
        return this;
    }

    // Phương thức để cập nhật Facebook Site Handle
    updateFbSite(newSite) {
        if (newSite !== undefined) this.fbSite = newSite;
        if (this.fbSite) {
            this.updateOrCreateMetaTag('property', 'fb:site', this.fbSite);
        }
        return this;
    }

    // Phương thức để cập nhật tất cả các thẻ cùng lúc
    updateAll() {
        this.updateTitle();
        this.updateMetaDescription();
        this.updateMetaKeywords();
        this.updateOgImage();
        this.updateOgUrl();
        this.updateOgType();
        this.updateOgSiteName();
        this.updateCanonical();
        this.updateFbSite();
        console.log("SEO tags updated by SeoManager.");
        return this;
    }
}