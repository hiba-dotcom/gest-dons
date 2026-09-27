<style>
    .header-section {
        background-color: var(--primary-color);
        color: white;
        background-image: url('https://images.unsplash.com/photo-1564769625688-8654b7f90667?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80');
        background-size: cover;
        background-position: center;
        background-blend-mode: overlay;
        position: relative;
    }

    .header-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: rgba(30, 58, 138, 0.85);
        z-index: 1;
    }

    .header-section>div {
        position: relative;
        z-index: 2;
    }

    .btn-primary {
        background-color: var(--secondary-color);
        color: white;
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(59, 130, 246, 0.25);
    }

    .btn-primary:hover {
        background-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(59, 130, 246, 0.3);
    }

    .btn-secondary {
        background-color: white;
        color: var(--primary-color);
        transition: all 0.3s ease;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .btn-secondary:hover {
        background-color: var(--accent-light);
        transform: translateY(-2px);
        box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15);
    }

    .section-title {
        color: var(--primary-color);
        border-bottom: 2px solid var(--accent-color);
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        display: inline-block;
    }

    .card {
        transition: all 0.3s ease;
        border-radius: 0.75rem;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid rgba(0, 0, 0, 0.05);
    }

    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
    }

    .footer {
        background-color: var(--primary-color);
        color: white;
    }

    .islamic-pattern {
        background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1NiIgaGVpZ2h0PSIxMDAiPgo8cmVjdCB3aWR0aD0iNTYiIGhlaWdodD0iMTAwIiBmaWxsPSIjZjhkZmNkIj48L3JlY3Q+CjxwYXRoIGQ9Ik0yOCA2NkwwIDUwTDAgMTZMMjggMEw1NiAxNkw1NiA1MEwyOCA2NkwyOCAxMDAiIGZpbGw9Im5vbmUiIHN0cm9rZT0iI2ZmZiIgc3Ryb2tlLW9wYWNpdHk9IjAuMDUiIHN0cm9rZS13aWR0aD0iMiI+PC9wYXRoPgo8cGF0aCBkPSJNMjggMEwyOCAzNEw1NiA1MEw1NiAxNiIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjMDAwIiBzdHJva2Utb3BhY2l0eT0iMC4wMiIgc3Ryb2tlLXdpZHRoPSIyIj48L3BhdGg+Cjwvc3ZnPg==');
        opacity: 0.1;
    }

    .nav-link {
        position: relative;
        padding-bottom: 2px;
    }

    .nav-link::after {
        content: '';
        position: absolute;
        width: 0;
        height: 2px;
        bottom: 0;
        left: 0;
        background-color: var(--accent-color);
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .prayer-times {
        background-color: var(--accent-light);
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    }

    .prayer-time-item {
        background-color: white;
        border-radius: 0.5rem;
        padding: 0.75rem;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .font-arabic {
        font-family: 'Amiri', serif;
    }

    .rtl {
        direction: rtl;
    }

    .ltr {
        direction: ltr;
    }

    .feature-card {
        border-top: 3px solid var(--accent-color);
    }

    .testimonial {
        position: relative;
        background-color: white;
        border-radius: 0.75rem;
        padding: 2rem;
        margin-top: 2rem;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
    }

    .testimonial::before {
        content: '"';
        position: absolute;
        top: 1rem;
        left: 1.5rem;
        font-size: 4rem;
        color: var(--accent-light);
        font-family: serif;
        line-height: 1;
    }

    .feature-icon {
        background-color: var(--accent-light);
        color: var(--accent-color);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 1rem;
    }

    .donation-card {
        background-color: white;
        border-radius: 0.75rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .donation-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
    }
    
    .language-menu {
        display: none;
        opacity: 0;
        transform: translateY(-10px);
        transition: all 0.3s ease;
        position: absolute;
        top: 100%;
        right: 0;
        margin-top: 0.5rem;
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        z-index: 50;
        min-width: 200px;
    }
    
    .language-menu.active {
        display: block;
        opacity: 1;
        transform: translateY(0);
    }
    
    .language-flag-box {
        width: 24px;
        height: 24px;
        border-radius: 4px;
        overflow: hidden;
        margin-right: 12px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    .language-flag {
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
    }
    
    .language-flag-fr {
        background-image: linear-gradient(to right, #002395 33%, white 33%, white 66%, #ed2939 66%);
    }
    
    .language-flag-ar {
        background-image: linear-gradient(to right, #007a3d 33%, white 33%, white 66%, #ce1126 66%);
    }
    
    .language-flag-en {
        background-image: linear-gradient(to right, #012169 33%, white 33%, white 66%, #c8102e 66%);
    }
    
    .language-option {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: var(--text-color);
        transition: all 0.2s ease;
    }

    .language-option:hover {
        background-color: var(--accent-light);
    }

    /* Floating Language Switcher */
    .floating-language-switcher {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
    }
    
    .floating-language-button {
        display: flex;
        align-items: center;
        gap: 10px;
        background-color: var(--primary-color);
        color: white;
        padding: 12px 20px;
        border-radius: 50px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .floating-language-button:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        background-color: var(--secondary-color);
        transform: translateY(-2px);
    }
    
    .floating-language-menu {
        position: absolute;
        bottom: 100%;
        right: 0;
        margin-bottom: 8px;
        background-color: white;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        display: none;
        min-width: 200px;
    }
    
    .floating-language-menu.show {
        display: block;
    }

    /* Notification Animation */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fade-in {
        animation: fadeIn 0.3s ease-out forwards;
    }
</style>