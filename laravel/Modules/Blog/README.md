# Module Blog Fila3 📚 Create, Manage, and Engage with Powerful Blog Features! 🚀

[![Latest Release](https://img.shields.io/github/v/release/laraxot/module_blog_fila3)](https://github.com/laraxot/module_blog_fila3/releases)
[![Build Status](https://img.shields.io/travis/laraxot/module_blog_fila3/master)](https://travis-ci.org/laraxot/module_blog_fila3)
[![Total Downloads](https://img.shields.io/packagist/dt/laraxot/module_blog_fila3)](https://packagist.org/packages/laraxot/module_blog_fila3)
[![License](https://img.shields.io/github/license/laraxot/module_blog_fila3)](LICENSE)

**Module Blog Fila3** is the ultimate blogging module for Laravel, allowing you to easily create, manage, and publish engaging blog content with robust functionality and seamless integration! ✨

---

### Key Features 🌟

- **Create and Manage Articles**: Write, edit, and publish engaging content effortlessly.
- **Category Management**: Organize your articles into clear, structured categories.
- **Banner Support**: Showcase featured articles with rotating banners.
- **User Profiles**: Manage author profiles to attribute and showcase contributors.
- **Frontend Flexibility**: Easily integrate the blog into your frontend with customizable templates.

---

### Installation Guide 💻

1. **Install the module:**
    ```bash
    git submodule add https://github.com/laraxot/module_blog_fila3.git Blog
    ```

2. **Run Migrations:**
    ```bash
    php artisan module:migrate Blog
    ```

3. **Enable the module:**
    ```bash
    php artisan module:enable Blog
    ```

4. **Check Active Modules:**
    ```bash
    php artisan module:list
    ```

---

### Models and Their Purpose 🛠️

- **Article**: Represents blog posts with rich content, including text, images, and custom blocks.
- **Category**: Groups articles under specific themes, such as Sports, Politics, or Science.
- **Banner**: Displays highlighted content as a carousel on the homepage for more visibility.
- **Profile**: Manages user profiles, allowing for author details and bio presentation on posts.

---

### Supercharged Console Commands 🚀

- **List Articles:**
    ```bash
    php artisan blog:articles
    ```
    _View all published blog articles._

- **Create a New Article:**
    ```bash
    php artisan blog:create <title>
    ```
    _Easily draft a new blog post._

- **Manage Categories:**
    ```bash
    php artisan blog:categories
    ```
    _View and manage the article categories._

---

### FAQ ❓

- **Q: How do I display the blog on my site?**
  A: The module integrates seamlessly with your frontend, providing customizable templates for listing articles, categories, and more.

- **Q: Can I schedule posts for future publication?**
  A: Yes! You can set publish dates for articles, allowing you to plan content ahead.

---

### Author 👨‍💻

Developed and maintained by [Marco Sottana](https://github.com/marco76tv)  
📧 Email: marco.sottana@gmail.com

---

### License 📄

This package is open-sourced under the [MIT license](LICENSE).

---

Take your content creation to the next level with **Module Blog Fila3**! 💥
