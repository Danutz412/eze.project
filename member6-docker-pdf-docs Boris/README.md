# Docker & PDF Documentation

This folder contains Docker configuration and PDF template resources for the EzePost application.

## 📁 Contents

- **Dockerfile** - PHP 8.3 FPM Docker image configuration
- **docker-compose.yml** - Docker Compose configuration for container orchestration
- **pdf-templates/** - Blade templates for PDF generation
- **app/** - Application-specific files
- **docker/** - Docker-related configuration files
- **resources/** - Additional resources

## 🐳 Docker Setup

### Prerequisites
- Docker Desktop installed
- Docker Compose installed

### Building the Docker Image

```bash
docker build -t ezepost-app .
```

### Running with Docker Compose

```bash
docker-compose up -d
```

## 📄 PDF Templates

The `pdf-templates/` directory contains Blade templates used for generating PDF receipts and documentation.

### Transfer Receipt Template
- **File**: `transfer-receipt.blade.php`
- **Purpose**: Generates PDF receipts for file transfers
- **Features**: 
  - Company branding
  - Transfer details
  - Sender/receiver information
  - Timestamps

## 🔧 Configuration

### Dockerfile Configuration
- Base image: PHP 8.3 FPM
- Extensions: pdo_mysql, mbstring, exif, pcntl, bcmath, gd
- Composer installed for dependency management

### Environment Variables
Configure environment variables in `docker-compose.yml` or `.env` file:
- Database connection
- Mail settings
- Stripe API keys

## 📝 Usage

### Generate PDF Receipt
```php
$pdf = \Barryvdh\DomPDF\Facade\Pdf::loadView('pdf.transfer-receipt', compact('transfer'));
return $pdf->download('ezepost-receipt-' . $transfer->transfer_reference . '.pdf');
```

## 🚀 Deployment

### Production Docker Deployment
1. Build the image
2. Push to container registry
3. Deploy to production server
4. Configure environment variables
5. Run migrations

## 📞 Support

For issues related to Docker setup or PDF generation, contact the development team.
