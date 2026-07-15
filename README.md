Inventory & Sales Management System

This repository contains an Inventory and Sales Management System designed to streamline stock tracking, vendor relations, and transactional reporting. git Built with Php/Laravel framework, the system ensures real-time tracking of stock levels while maintaining structured accountability for user-driven sales.

Database Architecture
The underlying database design (detailed in `image_490bdd.jpg`) utilizes a highly normalized schema consisting of 6 core tables to eliminate data redundancy and ensure transactional consistency:

Authentication & Roles (`Users`): Manages system access with distinct user accounts and operational roles.

Product Catalog (`Products` & `Categories`): Organizes inventory items into specific categories, enabling fast searching, filtering, and stock monitoring.
Supply Chain Management (`Suppliers`): Tracks vendor profiles and contact information, mapping suppliers directly to the products they provision.

Transactional Ledger (`Sales` & `Sales Details`): Uses a parent-child table relationship to separate high-level invoice metadata (date, user, total price) from individual line-item breakdowns (product, quantity, unit price).

Key Features

Normalized Relational Schema: Modeled using strict One-to-Many relationships to maintain data integrity across inventory and sales operations.

Referential Integrity: Enforced via comprehensive Primary Key (PK) and Foreign Key (FK) constraints, ensuring no orphaned transaction lines or untracked stock adjustments.

Audit-Ready Logs: Automatically attributes every sale to a specific user account for strict operational tracking.


Default Login Credentials - ID: admin@stockflow.com Password: yourpassword123