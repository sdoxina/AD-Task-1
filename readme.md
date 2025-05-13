<a name="readme-top">

<br/>

<br />
<div align="center">
  <a href="https://github.com/zyx-0314/">
    <img src="./assets/img/buttonconeLogo.png" alt="buttoncone" width="130" height="100">
  </a>
  <h3 align="center">Buttoncone</h3>
</div>
<div align="center">
  A simple crochet showcase website built with PHP, showcasing the use of PHP declarations, loops, and conditionals.
</div>

<br />

![](https://visit-counter.vercel.app/counter.png?page=sdoxina/AD-Task-1)

[![wakatime](https://wakatime.com/badge/user/65f5d1d3-0933-4b6c-b6df-d8bf043e70be/project/0cd0e766-588b-4d19-aa60-9dceb859b772.svg)](https://wakatime.com/badge/user/65f5d1d3-0933-4b6c-b6df-d8bf043e70be/project/0cd0e766-588b-4d19-aa60-9dceb859b772)

---

<br />
<br />

<!-- TODO: If you want to add more layers for your readme -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#overview">Overview</a>
      <ol>
        <li>
          <a href="#key-components">Key Components</a>
        </li>
        <li>
          <a href="#technology">Technology</a>
        </li>
      </ol>
    </li>
    <li>
      <a href="#rule,-practices-and-principles">Rules, Practices and Principles</a>
    </li>
    <li>
      <a href="#resources">Resources</a>
    </li>
  </ol>
</details>

---

## Overview

**Buttoncone** is a simple crochet item catalog site that demonstrates basic yet important PHP fundamentals including:
- Variable declaration and array handling
- Loops for rendering item listings
- Conditionals for filtering and greeting messages

This project displays a collection of handmade crochet items grouped by category (Clothing, Plushies, Bags). The user can view the categorized items on a single page. PHP is used to dynamically generate the items using loops and conditionals.

### How PHP is Used:

- **Declaration**: An associative array of items is declared in PHP. Each item includes a name, image, and category.
- **Looping**: The foreach loop is used to iterate through all items and render them as Bootstrap cards in the HTML.
- **Conditionals**: Items are grouped and shown based on their category using if conditions inside the loop. Time-based greetings like “Good Morning,” “Good Afternoon,” or “Good Evening” are also handled using PHP conditionals by checking the current server time with date('H').

### Key Components

- Homepage with greeting based on the time of day
- Items page showing filtered crochet items by category
- Responsive layout using Bootstrap
- Image assets dynamically rendered from PHP arrays

### Technology

#### Language
![HTML](https://img.shields.io/badge/HTML-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS](https://img.shields.io/badge/CSS-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)

#### Framework/Library
![Bootstrap](https://img.shields.io/badge/Bootstrap-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)

#### Deployment
![Vercel](https://img.shields.io/badge/Vercel-000000?style=for-the-badge&logo=vercel&logoColor=white)

## Rules, Practices and Principles

<!-- Do not Change this -->

1. Always use `AD-` in the front of the Title of the Project for the Subject followed by your custom naming.
2. Do not rename `.php` files if they are pages; always use `index.php` as the filename.
3. Add `.component` to the `.php` files if they are components code; example: `footer.component.php`.
4. Add `.util` to the `.php` files if they are utility codes; example: `account.util.php`.
5. Place Files in their respective folders.
6. Different file naming Cases
   | Naming Case | Type of code         | Example                           |
   | ----------- | -------------------- | --------------------------------- |
   | Pascal      | Utility              | Accoun.util.php                   |
   | Camel       | Components and Pages | index.php or footer.component.php |
8. Renaming of Pages folder names are a must, and relates to what it is doing or data it holding.
9. Use proper label in your github commits: `feat`, `fix`, `refactor` and `docs`
10. File Structure to follow below.

```
AD-ProjectName
└─ assets
|   └─ css
|   |   └─ name.css
|   └─ img
|   |   └─ name.jpeg/.jpg/.webp/.png
|   └─ js
|       └─ name.js
└─ components
|   └─ name.component.php
└─ pages
|  └─ pageName
|     └─ assets
|     |  └─ css
|     |  |  └─ name.css
|     |  └─ img
|     |  |  └─ name.jpeg/.jpg/.webp/.png
|     |  └─ js
|     |     └─ name.js
|     └─ index.php
└─ utils
|   └─ Name.utils.php
└─ index.php
└─ readme.md
```
> The following should be renamed: name.css, name.js, name.jpeg/.jpg/.webp/.png, name.component.php(but not the part of the `component.php`), Name.utils.php(but not the part of the `utils.php`)

## Resources

| Title        | Purpose                                                                       | Link          |
| ------------ | ----------------------------------------------------------------------------- | ------------- |
| Creating a Responsive Navigation Bar  | Provide guidance on creating a responsive navbar using Bootstrap 5 | [youtube.com](https://www.youtube.com/watch?v=h5apE3E72wY&list=PLL_WPHglaFqyYdX6ED168NWAtEmklolVH&index=3) |
