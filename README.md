# DEIB Inclusion Checker

The project aims to develop an "Inclusion Checker" plugin for WordPress, designed to assist contributors in creating content that is accessible, inclusive, and clear, particularly for a global audience with diverse linguistic and cultural backgrounds. This tool will be particularly useful for contributors publishing on Make/WordPress, handling developer and user documentation, meeting notes, release notes, support responses, and bug reports.

## Objectives

- **Enhance Inclusivity**: Ensure that all content is respectful and inclusive, avoiding language that might be inadvertently exclusive or insensitive.
- **Improve Accessibility**: Check for compliance with web accessibility standards, including semantic HTML, appropriate use of title and alt tags, and color contrast.
- **Boost Readability**: Aid in crafting content that is easy to read and understand, especially for non-native English speakers.
- **Seamless Integration**: Work efficiently within the WordPress block editor and support content synced from GitHub repositories.

## Target Users

- WordPress contributors involved in various capacities: meeting coordinators, documentation writers, release note publishers, support responders, and bug reporters.
- A special focus on non-native English speakers and contributors from diverse cultural backgrounds.

## Key Features

- **Inclusive Language Suggestions**: Real-time suggestions for more inclusive language.

## Future Key Features

- **Accessibility Checks**: Automated checks for HTML elements, color contrast, and other accessibility standards.
- **Readability Analysis**: Assessment of content complexity, offering suggestions for simplification.
- **Interactive Interface**: User-friendly highlights and hover popovers for instant feedback, and an educational section in the WordPress editor side panel.

## Installation

1. Ensure you have a working multisite
1. Clone this repository to `wp-content/plugins/`
1. Head to your plugin administration page
1. Activate the Plugin "DEIB Inclusion Checker"

## Contributing

### Contributor Code of Conduct

Please note that this project is adapting the [Contributor Code of Conduct](https://learn.wordpress.org/online-workshops/code-of-conduct/) from WordPress.org. By participating in this project you agree to abide by its terms.

### Basic Workflow

* Grab an issue
* Fork the project
* Add a branch with the number of your issue
* Develop your stuff
* Commit to your forked project
* Send a pull request to the main branch with all the details

Please make sure that you have [set up your user name and email address](https://git-scm.com/book/en/v2/Getting-Started-First-Time-Git-Setup) for use with Git. Strings such as `silly nick name <root@localhost>` look really stupid in the commit history of a project.

Due to time constraints, you may not always get a quick response. Please do not take delays personally and feel free to remind.

### Workflow Process

* Every new issue gets the label 'Request'
* After reviewing the issue it will receive the actual label (e.g. "Enhancement", "Bug")
* The issues will selected by the developer team
* Every commit must be linked to the issue with following pattern: `#${ISSUENUMBER} - ${MESSAGE}`
* Every PR only contains one commit and one reference to a specific issue

### Coding Guidelines

* We are using the [WordPress Coding Standard](https://developer.wordpress.org/coding-standards/wordpress-coding-standards/). You can use the `composer install && composer cs` to test it.
