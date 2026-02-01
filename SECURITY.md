# Security Policy

## Supported Versions

| Version | Supported          |
| ------- | ------------------ |
| 1.x.x   | :white_check_mark: |

## Reporting a Vulnerability

We take the security of KoohenCart seriously. If you discover a security vulnerability, please follow these steps:

### 🔒 Private Disclosure

**Please do NOT report security vulnerabilities through public GitHub issues.**

Instead, please report them via email to: **security@youremail.com**

### What to Include

When reporting a vulnerability, please include:

1. **Description** of the vulnerability
2. **Steps to reproduce** the issue
3. **Potential impact** of the vulnerability
4. **Suggested fix** (if you have one)
5. **Your contact information** for follow-up

### Response Timeline

- **Initial Response**: Within 48 hours
- **Status Update**: Within 7 days
- **Resolution Target**: Within 30 days (depending on severity)

### After Reporting

1. We will acknowledge your report within 48 hours
2. We will investigate and validate the vulnerability
3. We will work on a fix and coordinate disclosure
4. We will credit you (unless you prefer to remain anonymous)

## Security Best Practices

When deploying KoohenCart, please ensure:

### Environment Configuration
- Set `APP_DEBUG=false` in production
- Use strong, unique `APP_KEY`
- Configure proper database credentials
- Use HTTPS for all connections

### Server Security
- Keep PHP and all dependencies updated
- Use proper file permissions
- Configure firewall rules
- Enable rate limiting

### Application Security
- Use strong admin passwords
- Enable two-factor authentication (when available)
- Regularly review user permissions
- Monitor logs for suspicious activity

## Security Features

KoohenCart includes several security features:

- ✅ CSRF Protection
- ✅ SQL Injection Prevention (Eloquent ORM)
- ✅ XSS Protection
- ✅ Password Hashing (bcrypt)
- ✅ Rate Limiting
- ✅ Role-Based Access Control
- ✅ Input Validation

## Acknowledgments

We appreciate the security research community and will acknowledge all valid reports in our security hall of fame (with permission).

---

Thank you for helping keep KoohenCart secure! 🛡️
