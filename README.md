# Matomo LoginTokenAuth Plugin

## Description

This plugin extends the standard Matomo authentication to allow `token_auth` Authentication.

How do I setup LoginTokenAuth using Matomo?

* Login to your Matomo as Super User. Click Settings, then click Marketplace.
* Install the LoginTokenAuth plugin, then click Activate.
* Login over the implemented logme method:

    `https://matomo.example.com/index.php?module=LoginTokenAuth&action=logme&token_auth=YOUR_TOKEN_STRING`

    * The TokenAuth login is allowed for all users except Super Users
    * You can use all parameters allowed by the default `logme`
    method provided by the default Login Matomo Plugin

## License

GPL v3+

