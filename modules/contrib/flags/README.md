Known issues:
  * Configuration entities for country mapping are not deleted
    when `flags` module is uninstalled.

    Adding dependencies for config entities as described [here](
    http://drupal.stackexchange.com/a/173879/5982) does not work.
    This means that in order reinstall flags module, all config
    entities needs to be removed either manually with SQL query
    ```SQL
    DELETE FROM config WHERE name LIKE '%flags_countries%';
    ```
    or with PHP (drupal console) as explained
    [here](http://drupal.stackexchange.com/q/164612/5982).

  * After revamping of config entities and UI we probably no longer
    need separate config entities for storing mapping. A simple
    array similar to the list of all available flags would
    probably be enough to suit our needs.
