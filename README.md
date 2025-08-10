# PHP Multi-Format Product Exporter

## Overview  
**PHP Multi-Format Product Exporter** is a PHP web application that retrieves product data from a database and exports it into multiple formats — **XML**, **JSON**, and **PDF**.  
Built on the `fhooe/router-skeleton` framework, the project demonstrates how to integrate data fetching, format conversion, and file generation in a server-side PHP application.

## Why this project exists  
This project was developed to:  
- Demonstrate **multi-format data export** capabilities in PHP.  
- Show integration of database queries with multiple output formats.  
- Provide examples of **server-side file generation** for XML, JSON, and PDF.  

## Features  
- **Product Data Retrieval** — Fetch product records from a database.  
- **XML Export** — Structured hierarchical format for interoperability.  
- **JSON Export** — Lightweight, widely-used format for APIs and applications.  
- **PDF Export** — Printer-friendly, styled export using a PDF generation library.  
- **Router Integration** — Organized URL handling via `fhooe/router-skeleton`.  
- **Public Directory Output** — All generated files stored in `/public` for easy access.

## Technologies used  
- **Backend:** PHP 8+  
- **Framework:** `fhooe/router-skeleton`  
- **Database:** MySQL/MariaDB  
- **PDF Generation:** PHP PDF library (e.g., TCPDF, Dompdf, or similar)  
- **Serialization:** Built-in PHP functions for XML and JSON encoding

## How to run the project  
```bash
# 1) Adjust the base path in public/index.php (line 52)

# 2) Start Docker and open a Bash shell in the container
docker exec -it webapp /bin/bash

# 3) Navigate to the exporter folder
cd t1-ue07-YourTeamName/exporter

# 4) Install dependencies
composer install

# 5) Access the application in the browser and trigger exports
http://localhost:8000
```

## Dependencies & requirements  
- PHP 8+  
- Composer  
- MySQL/MariaDB  
- Docker (recommended for environment setup)  

## How to contribute  
1. Fork the repository and create a feature branch.  
2. Add support for new export formats or enhance the existing ones.  
3. Ensure database queries remain optimized.  
4. Submit a pull request with a clear explanation.

## What powers the core functionality?  
- **Database layer** — Fetches product data.  
- **Export logic** — Converts records to XML, JSON, and PDF formats.  
- **Router skeleton** — Manages routes for triggering exports.
