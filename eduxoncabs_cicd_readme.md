# CI/CD Deployment for Eduxoncabs

## Overview

This repository uses GitHub Actions for automated deployment to staging and production environments via cPanel.

- **Staging**: Push to `stage` branch → updates staging server
- **Production**: Push to `main` branch → updates production server
- **Authentication**: Single SSH deploy key for secure server access
- **Process**: Automated pulling, file copying, and permission setting

## Prerequisites

- Access to cPanel for both staging and production servers
- SSH access enabled on both servers
- Git repositories configured on both servers

## SSH Key Setup

### 1. Generate SSH Key Pair

```bash
ssh-keygen -t rsa -b 4096 -C "eduxoncabs-github-deploy-key" -f ~/eduxoncabs_deploy_key
```

### 2. Upload Public Key to cPanel

For both staging and production servers:
1. Navigate to **cPanel** → **Security** → **SSH Access**
2. Select **Manage SSH Keys**
3. Click **Import Key**
4. Upload the public key file
5. Click **Authorize** to enable the key

### 3. Set Server Permissions

```bash
chmod 700 ~/.ssh
chmod 600 ~/.ssh/authorized_keys
```

### 4. Test SSH Connection

Test passwordless SSH access to both servers:

```bash
# Staging
ssh -i ~/eduxoncabs_deploy_key pm2f7nn8yhci@staging.eduxoncabs.com

# Production
ssh -i ~/eduxoncabs_deploy_key pm2f7nn8yhci@production.eduxoncabs.com
```

## Manual Deployment Commands

### Staging Deployment

```bash
ssh -i ~/eduxoncabs_deploy_key pm2f7nn8yhci@staging.eduxoncabs.com
cd /home/pm2f7nn8yhci/repositories/stage_eduxoncabs
git reset --hard
git pull origin stage
cp -r stage/eduxoncabs/html/* /home/pm2f7nn8yhci/stage_public_html/
chmod -R 755 /home/pm2f7nn8yhci/stage_public_html/
```

### Production Deployment

```bash
ssh -i ~/eduxoncabs_deploy_key pm2f7nn8yhci@production.eduxoncabs.com
cd /home/pm2f7nn8yhci/repositories/prod_eduxoncabs
git reset --hard
git pull origin main
cp -r prod/eduxoncabs/html/* /home/pm2f7nn8yhci/public_html/
chmod -R 755 /home/pm2f7nn8yhci/public_html/
```

## GitHub Actions Configuration

### GitHub Secrets

Add the following secret to your GitHub repository:
- `STAGE_SSH_KEY`: Private SSH key content (used for both staging and production)

**To add secrets:**
1. Go to repository **Settings** → **Secrets and variables** → **Actions**
2. Click **New repository secret**
3. Add the private key content

### Staging Workflow

Create `.github/workflows/deploy-stage.yml`:

```yaml
name: Deploy to Staging

on:
  push:
    branches:
      - stage

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
      - uses: actions/checkout@v3
      
      - uses: webfactory/ssh-agent@v0.8.1
        with:
          ssh-private-key: ${{ secrets.STAGE_SSH_KEY }}
      
      - name: Deploy to Staging Server
        run: |
          ssh -o StrictHostKeyChecking=no pm2f7nn8yhci@staging.eduxoncabs.com << 'EOF'
          cd /home/pm2f7nn8yhci/repositories/stage_eduxoncabs
          git reset --hard
          git pull origin stage
          cp -r stage/eduxoncabs/html/* /home/pm2f7nn8yhci/stage_public_html/
          chmod -R 755 /home/pm2f7nn8yhci/stage_public_html/
          EOF
```

### Production Workflow

Create `.github/workflows/deploy-prod.yml`:

```yaml
name: Deploy to Production

on:
  push:
    branches:
      - main

jobs:
  deploy:
    runs-on: ubuntu-latest
    
    steps:
      - uses: actions/checkout@v3
      
      - uses: webfactory/ssh-agent@v0.8.1
        with:
          ssh-private-key: ${{ secrets.STAGE_SSH_KEY }}
      
      - name: Deploy to Production Server
        run: |
          ssh -o StrictHostKeyChecking=no pm2f7nn8yhci@production.eduxoncabs.com << 'EOF'
          cd /home/pm2f7nn8yhci/repositories/prod_eduxoncabs
          git reset --hard
          git pull origin main
          cp -r prod/eduxoncabs/html/* /home/pm2f7nn8yhci/public_html/
          chmod -R 755 /home/pm2f7nn8yhci/public_html/
          EOF
```

## Deployment Process

### For Staging
1. Make changes to your code
2. Commit and push to the `stage` branch
3. GitHub Actions automatically deploys to staging server
4. Verify changes at staging URL

### For Production
1. Merge approved changes from `stage` to `main` branch
2. Push to `main` branch
3. GitHub Actions automatically deploys to production server
4. Verify changes at production URL

## Directory Structure

```
/home/pm2f7nn8yhci/
├── repositories/
│   ├── stage_eduxoncabs/          # Staging git repository
│   └── prod_eduxoncabs/           # Production git repository
├── stage_public_html/             # Staging web root
└── public_html/                   # Production web root
```

## Troubleshooting

### SSH Connection Issues
- Verify SSH key permissions (700 for ~/.ssh, 600 for key files)
- Ensure public key is authorized in cPanel
- Test manual SSH connection before using GitHub Actions

### Deployment Failures
- Check GitHub Actions logs for error details
- Verify repository paths on server
- Ensure proper file permissions on target directories
- Confirm git repository is properly configured on server

### File Permission Issues
- Ensure web server has read access to deployed files
- Verify chmod commands are executing successfully
- Check that target directories exist and are writable

## Security Notes

- Keep private SSH keys secure and never commit to repository
- Use GitHub Secrets for sensitive information
- Regularly rotate SSH keys for enhanced security
- Monitor deployment logs for any unauthorized access attempts

Credentials:

  staging:
    DB_CONNECTION=mysql
    DB_HOST=mysql-eduxoncabs.alwaysdata.net
    DB_PORT=3306
    DB_DATABASE=eduxoncabs_stage
    DB_USER=431397_username
    DB_PASSWORD=9090Aksingh_

  prod:
    DB_HOST=localhost
    DB_USER=eduxonca_buser
    DB_PASSWORD=Admin@3211
    DB_NAME=eduxcabdb

  alwaysdata:
    shashankshekharofficial15@Gmail.com
    9090Aksingh_