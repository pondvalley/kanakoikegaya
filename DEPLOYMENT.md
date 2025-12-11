# GitHub Actions Deployment Setup

This guide will help you set up automatic deployment from GitHub to your VPS server.

## Prerequisites

- VPS server with SSH access
- PHP 8.1+ installed on VPS
- Composer installed on VPS
- Git repository pushed to GitHub

## Step 1: Generate SSH Key for GitHub Actions

On your **local machine**, generate a new SSH key pair for GitHub Actions:

```bash
ssh-keygen -t ed25519 -C "github-actions-deploy" -f ~/.ssh/github_actions_deploy
```

Press Enter to skip the passphrase (GitHub Actions needs a key without passphrase).

This creates two files:
- `~/.ssh/github_actions_deploy` (private key) - for GitHub Secrets
- `~/.ssh/github_actions_deploy.pub` (public key) - for VPS server

## Step 2: Add Public Key to VPS Server

Copy the public key to your VPS:

```bash
# Display the public key
cat ~/.ssh/github_actions_deploy.pub

# SSH into your VPS and add it to authorized_keys
ssh your-username@your-vps-ip

# On the VPS:
mkdir -p ~/.ssh
chmod 700 ~/.ssh
nano ~/.ssh/authorized_keys
# Paste the public key on a new line, save and exit

# Set correct permissions
chmod 600 ~/.ssh/authorized_keys
```

## Step 3: Configure GitHub Secrets

Go to your GitHub repository:
**https://github.com/pondvalley/kanakoikegaya/settings/secrets/actions**

Click **"New repository secret"** and add these secrets:

### Required Secrets:

1. **VPS_HOST**
   - Value: Your VPS IP address or domain
   - Example: `123.45.67.89` or `yourdomain.com`

2. **VPS_USERNAME**
   - Value: Your SSH username on VPS
   - Example: `ubuntu` or `root` or your custom user

3. **VPS_SSH_KEY**
   - Value: Content of the PRIVATE key
   ```bash
   cat ~/.ssh/github_actions_deploy
   ```
   - Copy the entire output (including `-----BEGIN OPENSSH PRIVATE KEY-----` and `-----END OPENSSH PRIVATE KEY-----`)

4. **VPS_PORT**
   - Value: SSH port (usually `22`)
   - Example: `22`

5. **VPS_PATH**
   - Value: Absolute path to your website directory on VPS
   - Example: `/var/www/kanakoikegaya` or `/home/username/public_html`

## Step 4: Prepare VPS Directory Structure

SSH into your VPS and create the deployment directory:

```bash
ssh your-username@your-vps-ip

# Create website directory (adjust path as needed)
sudo mkdir -p /var/www/kanakoikegaya

# Set correct ownership
sudo chown -R your-username:your-username /var/www/kanakoikegaya

# Navigate to directory
cd /var/www/kanakoikegaya
```

## Step 5: Test the Deployment

After setting up all secrets, commit and push this workflow:

```bash
git add .github/workflows/deploy.yml DEPLOYMENT.md
git commit -m "Add GitHub Actions deployment workflow"
git push origin main
```

Go to your repository's **Actions** tab to see the deployment in progress:
**https://github.com/pondvalley/kanakoikegaya/actions**

## Step 6: Configure Web Server

### For Apache:

Create a virtual host configuration:

```apache
<VirtualHost *:80>
    ServerName yourdomain.com
    DocumentRoot /var/www/kanakoikegaya

    <Directory /var/www/kanakoikegaya>
        AllowOverride All
        Require all granted
    </Directory>

    ErrorLog ${APACHE_LOG_DIR}/kanakoikegaya-error.log
    CustomLog ${APACHE_LOG_DIR}/kanakoikegaya-access.log combined
</VirtualHost>
```

Enable the site and restart Apache:
```bash
sudo a2ensite kanakoikegaya.conf
sudo systemctl restart apache2
```

### For Nginx:

Create a server block:

```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/kanakoikegaya;
    index index.php;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.ht {
        deny all;
    }
}
```

Test and reload Nginx:
```bash
sudo nginx -t
sudo systemctl reload nginx
```

## Workflow Behavior

The GitHub Action will:

1. ✅ Trigger on every push to `main` branch
2. ✅ Install Node.js dependencies
3. ✅ Build Tailwind CSS (minified for production)
4. ✅ Deploy files to VPS via SCP
5. ✅ Run `composer install` on VPS
6. ✅ Clear Kirby cache

## Important Notes

### Files NOT Deployed:
- `node_modules/` - Only built CSS is deployed
- `vendor/` - Installed fresh on VPS via Composer
- `site/accounts/` - User accounts (gitignored)
- `site/sessions/` - Sessions (gitignored)
- `media/` - Upload media manually or via rsync

### First Deployment:

For the first deployment, you may need to manually:

1. Upload `/media/` directory with existing images
2. Create `/site/accounts/` directory and user accounts
3. Set proper file permissions

```bash
# On VPS
cd /var/www/kanakoikegaya
chmod -R 755 .
chmod -R 775 content media site/cache site/sessions
```

## Troubleshooting

### Deployment fails with "Permission denied"
- Check file ownership: `sudo chown -R your-username:your-username /var/www/kanakoikegaya`
- Verify SSH key is added to VPS `~/.ssh/authorized_keys`

### Composer command fails
- Ensure Composer is installed on VPS: `composer --version`
- Check PHP version: `php -v` (needs 8.1+)

### Website shows errors after deployment
- Check PHP error logs: `tail -f /var/log/apache2/kanakoikegaya-error.log`
- Verify file permissions
- Clear cache: `rm -rf site/cache/*`

## Security Recommendations

1. **Use a dedicated deployment user** on VPS (not root)
2. **Set up SSL certificate** with Let's Encrypt
3. **Change SSH port** from default 22 (optional but recommended)
4. **Enable firewall** (ufw or iptables)
5. **Keep the private key secure** - never commit it to Git

## Manual Deployment (Alternative)

If GitHub Actions fails, you can deploy manually:

```bash
# From your local machine
npm run build
rsync -avz --exclude 'node_modules' --exclude 'vendor' --exclude '.git' \
  ./ your-username@your-vps-ip:/var/www/kanakoikegaya/

# Then SSH to VPS and run:
ssh your-username@your-vps-ip
cd /var/www/kanakoikegaya
composer install --no-dev
```

---

## Questions?

If you encounter issues, check the GitHub Actions logs at:
https://github.com/pondvalley/kanakoikegaya/actions
