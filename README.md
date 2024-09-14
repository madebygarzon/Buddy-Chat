# User Manual for **AvatarBuddy Redirect** Plugin

## Table of Contents:
1. [General Description](#general-description)
2. [Plugin Installation](#plugin-installation)
3. [Plugin Configuration](#plugin-configuration)
   - [Entering the Secret Key and SSO URL](#entering-the-secret-key-and-sso-url)
4. [How to Use the Plugin](#how-to-use-the-plugin)

---

## General Description

The **AvatarBuddy Redirect** plugin allows users to authenticate and redirect to the **AvatarBuddy** platform using a secure SSO (Single Sign-On) link. The plugin generates a unique token each time the user clicks the "Try Me" button. This button can be integrated into any page or post on your WordPress site using a shortcode.

The plugin ensures that users are redirected correctly by generating a new token each time they interact with the button. Additionally, the secret keys and URL used for authentication can be easily configured from the WordPress admin panel.

---

## Plugin Installation

Follow these steps to install the plugin on your WordPress site:

1. **Download the plugin file**: Ensure you have the plugin file available in `.zip` format or uploaded to your site folder.
   
2. **Upload the plugin to WordPress**:
   - Log into your **WordPress Admin Panel**.
   - In the left-hand menu, go to **Plugins > Add New**.
   - Click **Upload Plugin** and select the `.zip` plugin file.
   - Click **Install Now**, and then **Activate**.

3. **Verification**: Once activated, you will see a new option called **AvatarBuddy** in the WordPress admin menu.

---

## Plugin Configuration

For the plugin to function correctly, you need to enter the **secret key** and the **SSO URL** provided by **AvatarBuddy**. These details are essential for the plugin to generate secure links.

### Entering the Secret Key and SSO URL

1. **Access the Settings Panel**:
   - In the WordPress admin menu, click on **AvatarBuddy**.
   - This will open the **AvatarBuddy Settings** page.

2. **Enter the Secret Key**:
   - You will see a field called **AvatarBuddy Secret Key**.
   - Enter the **secret key** provided by AvatarBuddy in this field. This key is a secure value used to generate the authentication token.

3. **Enter the SSO URL**:
   - Below the secret key field, you will find a field called **AvatarBuddy SSO URL**.
   - Enter the **SSO URL** provided by AvatarBuddy. This is the address where users will be redirected after authentication.

4. **Save Changes**:
   - Once you have entered the information, click the **Save Changes** button to store the configuration.

You're all set! The plugin is now fully configured and ready to be used on your website.

---

## How to Use the Plugin

Once the plugin is installed and configured, you can integrate the "Try Me" button on any page or post of your WordPress site using a shortcode.

### Using the Shortcode

1. **Add the Button to a Page or Post**:
   - Open the editor of the page or post where you want to include the button.
   - Type the following shortcode where you want the button to appear:
     ```
     [avatarbuddy_form]
     ```
   - Save or publish the page.

2. **Button Functionality**:
   - When users click the "Try Me" button, a new security token will be generated, and they will be redirected to the URL configured in the AvatarBuddy admin panel.

### Additional Notes:
- On **desktop devices**, the link will open in a new browser tab.
- On **mobile devices**, the link will redirect in the same tab.

---

## Frequently Asked Questions (FAQ)

1. **What should I do if I don’t have the secret key or SSO URL?**
   - These details are provided by **AvatarBuddy**. Contact AvatarBuddy support to obtain this information.

2. **Can I change the secret key and SSO URL after configuration?**
   - Yes, you can modify these settings anytime from the AvatarBuddy settings panel in the WordPress admin area.

3. **The button does not redirect on mobile, what should I do?**
   - Ensure you have correctly entered the **secret key** and **SSO URL** in the plugin settings. If the issue persists, try deactivating and reactivating the plugin.

---

This is the basic functionality and installation guide for the **AvatarBuddy Redirect** plugin. If you have further questions or issues, feel free to contact your administrator or AvatarBuddy support.
