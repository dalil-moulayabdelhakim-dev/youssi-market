# Youssi Market - Algerian Multi-Vendor E-Commerce Platform

**Youssi Market** is a robust, production-ready multi-vendor e-commerce solution built with Laravel 12. Specifically tailored for the Algerian market, it addresses regional challenges such as Cash on Delivery (COD) reliability, manual payment verification (BaridiMob/CCP), and Wilaya-based shipping logistics.

---

## 🚀 Key Features

### 🏢 Multi-Vendor Ecosystem
- **Three-Tier Roles:** Admin, Seller (Store Owner), and Customer.
- **Smart Subscription Enforcement:** Automatic marketplace visibility control. Products are hidden the moment a subscription expires using `ActiveStoreScope`.
- **Seller Dashboard:** Comprehensive visual analytics using **ApexCharts**, order fulfillment, and product management.
- **Admin Command Center:** Centralized management of users, store approvals, and financial auditing.

### 💸 Financial & Security Architecture
- **COD Escrow System:** Mitigates return (Retour) fraud by holding seller earnings in a `holding_balance` for 7 days before moving to `withdrawable_balance`.
- **Anti-Forgery Payment Proofs:** Secure manual verification workflow for BaridiMob/CCP receipts with unique transaction reference tracking.
- **Grace Period Logic:** Instant 48-hour access for sellers upon proof submission to ensure zero business downtime during review.
- **Atomic Financials:** High-integrity ledger tracking for commissions and payout requests.

### 🚚 Advanced Logistics
- **Dynamic Shipping Matrix:** Weight-aware delivery calculation. Supports base rates per Wilaya plus incremental fees per extra kilogram.
- **Flexible Delivery Types:** Custom pricing for both "Home Delivery" and "Office/StopDesk" across all 58 Algerian Wilayas.

### 🌍 Localization
- **Bilingual Support:** Fully localized in **Arabic** and **English**.
- **RTL Ready:** Native Right-to-Left layout support for a seamless Arabic user experience.

---

## 🛠️ Tech Stack

- **Backend:** Laravel 12.x (PHP 8.3+)
- **Frontend:** Livewire, TailwindCSS
- **Admin/Seller UI:** FilamentPHP
- **Database:** MySQL / PostgreSQL
- **Analytics:** ApexCharts
- **CI/CD:** GitHub Actions

---

## ⚙️ Installation

1. **Clone the repository:**
   ```bash
   git clone https://github.com/your-username/youssi-market.git
   cd youssi-market
   ```

2. **Install dependencies:**
   ```bash
   composer install
   npm install && npm run build
   ```

3. **Configure environment:**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Setup database:**
   ```bash
   php artisan migrate --seed
   ```

5. **Start the application:**
   ```bash
   php artisan serve
   ```

---

## 🚢 Deployment

This project includes a GitHub Action for automated deployment. Ensure the following secrets are configured in your repository settings:
- `SSH_PRIVATE_KEY`
- `REMOTE_HOST`
- `REMOTE_USER`

---

## 📄 License

The Youssi Market platform is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
