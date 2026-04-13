# Smallmart - A responsive website for 'Responsive Dynamic Web Development'
A responsive dynamic website for a catalogue of (real) miniature items. Every product, and their associated images, are sourced from [Miniatures Shop](https://miniaturesshop.com/). All reviews and user accounts (except Administrator) were generated using Microsoft Copilot.

# To Do
- Responsive elements
- Animated web elements

## Optional tasks
- Category / search sorting (featured, newest, oldest)
    - Will require more columns in 'product' table
- Review sorting (highest, lowest, newest, oldest)
- User management
- Re-organise files and directories
    - Move re-used PHP code into 'functions.php'
- Sort each product into the correct category(ies)

# Things to note
- When signing up, there is not an option to set your display name. This is something that can be done after sign up in the user settings, redirected to after signing up and/or logging in, but should be an input field when signing up.
- The icons rely on [Google's Material Icons](https://fonts.google.com/icons), meaning that if their system went down this website would be unable to load their icons and create an ugly frontend. The necessary icons should, ideally, be stored on the web server to be loaded from for a both quick and reliable source of icons.
- User is not logged out automatically after a certain time period, only when the current session ends.
- When changing a user detail on the user page, there is no message to state whether the update was successful or not. The most obvious way of knowing if it was is when changing the display name, where the page is reloaded and the personalised welcome message is updated with the new display name.
- In my opinion, the 'wishlist_product' join table is not necessary, with a 'wishlist' column in the 'user' table with comma-separated product ids being viable enough. On top of this, someone spam adding and removing product from their wishlist can increment the 'wishlish_prod_id' to extreme values, and could end up failing when reaching the possible maximum while there is a scaling user-base. A cooldown for this function should also be put in place for each user, checking when their last change was and preventing it in the case of spam. Although using this JOIN table does allow for the possibility of an 'added datetime' as a column, which can be good for properly sorting the wishlist for the user.