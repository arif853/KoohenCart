# Contributing to KoohenCart

First off, thank you for considering contributing to KoohenCart! It's people like you that make KoohenCart such a great tool.

## Code of Conduct

By participating in this project, you are expected to uphold our Code of Conduct:
- Be respectful and inclusive
- Welcome newcomers and help them get started
- Focus on what is best for the community
- Show empathy towards other community members

## How Can I Contribute?

### 🐛 Reporting Bugs

Before creating bug reports, please check the existing issues to avoid duplicates. When you create a bug report, include as many details as possible:

**Bug Report Template:**
```
**Describe the bug**
A clear and concise description of what the bug is.

**To Reproduce**
Steps to reproduce the behavior:
1. Go to '...'
2. Click on '....'
3. Scroll down to '....'
4. See error

**Expected behavior**
A clear and concise description of what you expected to happen.

**Screenshots**
If applicable, add screenshots to help explain your problem.

**Environment:**
 - OS: [e.g. Windows 11]
 - PHP Version: [e.g. 8.2]
 - Laravel Version: [e.g. 10.x]
 - Browser: [e.g. Chrome 120]

**Additional context**
Add any other context about the problem here.
```

### 💡 Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion, please include:

- **Use a clear and descriptive title**
- **Provide a detailed description** of the suggested enhancement
- **Explain why this enhancement would be useful**
- **List any alternatives you've considered**

### 🔧 Pull Requests

1. **Fork the repository** and create your branch from `main`
2. **Follow the coding standards** (PSR-12 for PHP)
3. **Write meaningful commit messages**
4. **Add tests** for new functionality
5. **Update documentation** as needed
6. **Ensure all tests pass** before submitting

#### Pull Request Process

1. Update the README.md with details of changes if applicable
2. Update any relevant documentation
3. The PR will be merged once you have the sign-off of a maintainer

## Development Setup

### Prerequisites
- PHP >= 8.1
- Composer
- Node.js >= 18.x
- MySQL >= 8.0

### Local Development

```bash
# Clone your fork
git clone https://github.com/YOUR_USERNAME/koohencart.git
cd koohencart

# Add upstream remote
git remote add upstream https://github.com/ORIGINAL_OWNER/koohencart.git

# Install dependencies
composer install
npm install

# Setup environment
cp .env.example .env
php artisan key:generate

# Run migrations
php artisan migrate --seed

# Start development server
npm run dev
php artisan serve
```

### Running Tests

```bash
# Run PHP tests
php artisan test

# Run specific test
php artisan test --filter=TestName
```

## Coding Standards

### PHP (PSR-12)

- Use 4 spaces for indentation
- Method names should be in camelCase
- Class names should be in PascalCase
- Constants should be in UPPER_CASE

```php
<?php

namespace App\Services;

class OrderService
{
    public const STATUS_PENDING = 'pending';
    
    public function processOrder(Order $order): bool
    {
        // Implementation
    }
}
```

### Blade Templates

- Use proper indentation
- Keep logic minimal in views
- Use Livewire components for interactive elements

### JavaScript

- Use ES6+ syntax
- Follow consistent naming conventions
- Document complex functions

## Commit Messages

Use clear and meaningful commit messages:

```
feat: add product bulk import feature
fix: resolve cart quantity update issue
docs: update API documentation
style: format code according to PSR-12
refactor: simplify order processing logic
test: add tests for coupon validation
```

## Project Structure Guidelines

- **Controllers**: Keep them thin, use services for business logic
- **Models**: Define relationships and scopes
- **Livewire Components**: Handle frontend interactivity
- **Services**: Complex business logic
- **Requests**: Input validation

## Questions?

Feel free to open an issue with the `question` label or reach out to the maintainers.

## License

By contributing, you agree that your contributions will be licensed under the MIT License.

---

Thank you for contributing! 🎉
