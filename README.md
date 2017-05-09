# UserSecurityBundle


## Description:

Use this bundle to mitigate brute force dictionary attacks on your sites. Excessive failed logins will force users to recover their account, additional attempts
to circumvent that will block the user from specified webpages by returning an HTTP 500 response on all specified routes.

## Features.

SecurityBundle Provides the following features:

1. Prevent brute force attacks being carried out by limiting number of login attempts:
	1. When first limit is reached, redirect to an account recovery page.
	2. When secondary limit is reached, return an HTTP 500 status to block login pages etc.
3. All limits are configurable.
4. Routes to block are configurable.
5. Route for account recovery page is configurable.
6. Decoupled from UserBundle specifics. You can use this with any user bundle you like.
6. Redirect user to last page they were on upon successful login.
7. Redirect user to last page they were on upon successful logout.

## Documentation

Check out the documentation on the bundles [wiki page](https://github.com/bruery/admin-bundle/wiki).

## Support

For general support and questions, please use [Disqus](https://thebruery.disq.us).

If you think you find a bug or you have a feature idea to propose, feel free to open a issue
**after looking** at the [contributing guide](CONTRIBUTING.md).

## License

This package is available under the [MIT license](LICENSE).
