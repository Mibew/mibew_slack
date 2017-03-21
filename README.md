[![Stories in Ready](https://badge.waffle.io/dmcdaniel12/mibew_slack.png?label=ready&title=Ready)](https://waffle.io/dmcdaniel12/mibew_slack)
# Mibew Slack plugin

Provides Slack notifications when initiate a chat

## Installation

1. Get the archive with the plugin sources. You can download it from the [official site](https://mibew.org/plugins#mibew-slack) or build the plugin from sources.

2. Untar/unzip the plugin's archive.

3. Put files of the plugins to the `<Mibew root>/plugins`  folder.

4. Obtain a webhook key from Slack:

    a. Go to Slack.com , open your app directory, find and enter Incoming WebHooks app, click on Add Configuration

    b. Click on App Configuration. Choose the Channel it should post to, click on Add Incoming Webhook Integration

    c. Copy the Webhook URL

5. Add plugins config to plugins structure like below.

    ```yaml
    plugins:
        "Mibew:Slack": # Plugin's configurations are described below
            username:	"Username you will post as"
            channel:	"Channel to post in"
            slack_url:	"Webhook URL from Setup Instructions in Slack"
    ```


## Plugin's configurations

The plugin can be configured with values in "`<Mibew root>`/configs/config.yml" file.

## Build from sources

There are several actions one should do before use the latest version of the plugin from the repository:

1. Obtain a copy of the repository using `git clone`, download button, or another way.
2. Install [node.js](http://nodejs.org/) and [npm](https://www.npmjs.org/).
3. Install [Gulp](http://gulpjs.com/).
4. Install npm dependencies using `npm install`.
5. Run Gulp to build the sources using `gulp default`.

Finally `.tar.gz` and `.zip` archives of the ready-to-use Plugin will be available in `release` directory.


## License

[Apache License 2.0](http://www.apache.org/licenses/LICENSE-2.0.html)
