# Contributing to Laravel Vue Chat Application

Thank you for considering contributing to this project! This document provides guidelines and instructions for contributing.

## Code of Conduct

This project adheres to a Code of Conduct. By participating, you are expected to uphold this code. Please read [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) before contributing.

## How Can I Contribute?

### Reporting Bugs

Before creating bug reports, please check existing issues to avoid duplicates. When creating a bug report, include:

- **Clear title and description**
- **Steps to reproduce** the issue
- **Expected behavior** vs actual behavior
- **Screenshots** if applicable
- **Environment details** (OS, PHP version, Laravel version, browser)
- **Error messages** or logs

### Suggesting Enhancements

Enhancement suggestions are tracked as GitHub issues. When creating an enhancement suggestion:

- **Use a clear and descriptive title**
- **Provide detailed description** of the proposed feature
- **Explain why this enhancement would be useful**
- **Include mockups or examples** if applicable

### Pull Requests

1. **Fork the repository** and create your branch from `develop`
2. **Follow the coding standards** (see below)
3. **Write tests** for new features
4. **Update documentation** as needed
5. **Ensure tests pass** before submitting
6. **Submit your pull request** with a clear description

## Development Setup

1. Fork and clone the repository:
```bash
git clone https://github.com/feraandrei1/template-laravel-app.git
cd template-laravel-app
```

2. Install dependencies:
```bash
composer install
npm install
```

3. Set up your environment:
```bash
cp .env.example .env
php artisan key:generate
```

4. Configure your database and run migrations:
```bash
php artisan migrate
```

5. Build assets:
```bash
npm run build
```

## Coding Standards

### PHP Code Style

This project uses **Laravel Pint** for PHP code formatting. Before committing:

```bash
vendor/bin/pint
```

Follow these conventions:
- Use **PHP 8 constructor property promotion**
- Add **explicit return type declarations** for all methods
- Use **curly braces** for all control structures, even single-line
- Prefer **Eloquent relationships** over raw queries
- Avoid `env()` outside config files - use `config()` instead
- Create **Form Request classes** for validation

### JavaScript/Vue Code Style

This project uses **ESLint** and **Prettier** for JavaScript/Vue formatting:

```bash
# Format code
npm run format

# Lint code
npm run lint
```

Follow these conventions:
- Use **TypeScript** for type safety
- Use **Composition API** with `<script setup>` in Vue components
- Follow **Vue 3 best practices**
- Use **Wayfinder** for type-safe routing
- Prefer **named imports** for tree-shaking

### Vue Component Guidelines

- Single root element per component
- Use descriptive component names (PascalCase)
- Props should have explicit types
- Emit events with clear names
- Use `<Form>` component for Inertia forms when possible

### Testing

All contributions should include appropriate tests:

**Feature Tests** (for most changes):
```bash
php artisan make:test FeatureNameTest
```

**Unit Tests** (for isolated logic):
```bash
php artisan make:test UnitNameTest --unit
```

Run tests before submitting:
```bash
php artisan test
```

#### Test Guidelines

- Use **Pest** testing framework
- Use **model factories** instead of manual model creation
- Test happy paths, failure paths, and edge cases
- Use **specific assertion methods** (`assertForbidden` instead of `assertStatus(403)`)
- Mock external services when appropriate
- Use **datasets** for testing multiple scenarios

## Git Workflow

### Branching Strategy

- `main` - Production-ready code
- `develop` - Development branch
- `feature/feature-name` - New features
- `bugfix/bug-name` - Bug fixes
- `hotfix/issue-name` - Urgent production fixes

### Commit Messages

Follow conventional commits format:

```
type(scope): subject

body (optional)

footer (optional)
```

**Types:**
- `feat`: New feature
- `fix`: Bug fix
- `docs`: Documentation changes
- `style`: Code style changes (formatting, etc.)
- `refactor`: Code refactoring
- `test`: Adding or updating tests
- `chore`: Maintenance tasks

**Examples:**
```
feat(chat): add message reactions feature

fix(auth): resolve 2FA validation issue

docs(readme): update installation instructions
```

### Pull Request Process

1. **Create a feature branch** from `develop`:
```bash
git checkout develop
git pull origin develop
git checkout -b feature/your-feature-name
```

2. **Make your changes** following coding standards

3. **Commit your changes** with clear messages:
```bash
git add .
git commit -m "feat(scope): description"
```

4. **Run tests and formatting**:
```bash
vendor/bin/pint
npm run format
npm run lint
php artisan test
```

5. **Push to your fork**:
```bash
git push origin feature/your-feature-name
```

6. **Create a Pull Request** on GitHub:
   - Target the `develop` branch
   - Provide clear title and description
   - Reference related issues
   - Include screenshots for UI changes

7. **Wait for review** and address feedback

### PR Requirements

- [ ] Code follows project style guidelines
- [ ] Tests pass locally
- [ ] New tests added for new features
- [ ] Documentation updated if needed
- [ ] No merge conflicts with target branch
- [ ] Commit messages are clear and descriptive

## Database Changes

When making database changes:

1. **Create migrations** using Artisan:
```bash
php artisan make:migration create_table_name
```

2. **Update model factories** if needed
3. **Update seeders** if needed
4. **Test migrations** can be rolled back:
```bash
php artisan migrate:rollback
```

## Documentation

Update documentation when:
- Adding new features
- Changing existing functionality
- Adding new configuration options
- Modifying installation steps

Documentation locations:
- `README.md` - Installation and overview
- `CONTRIBUTING.md` - This file
- Code comments - For complex logic
- PHPDoc blocks - For classes and methods

## Questions?

- Check existing issues and pull requests
- Review the README and documentation
- Open a discussion on GitHub
- Contact the maintainers

## License

By contributing to this project, you agree that your contributions will be licensed under the MIT License.

Thank you for contributing!
