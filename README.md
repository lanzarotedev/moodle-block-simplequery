# Moodle Block Plugin SimpleQuery

Basic example of Block plugin for database queries. The plugin contains only skeleton structure.
Except output of SQL results, it also adds two tables:

* **seminars** (table 1)
    * id (auto increment integer)
    * starttime int(10)
    * endtime int(10)
    * title char(255) (not unique)
    * description text (Moodle longtext)

* **seminars_bookings** (table 2)
    * id (auto incremented integer)
    * userid int(10)
    * seminarid int(10)
    * status int(1)
    
**Moodle prefix: mdl_**

In **seminars_bookings** table for _userid_ field foreign key points to mdl_user.id table, and _seminarid_ has foreign key pointing to mdl_seminars.id

The tables were created using Moodle interface: **XMLDB Editor** which creates **install.xml** file in db directory. Moodle uses the file during plugin installation to create tables.

#Additional Video Resources:
* [**How to create Moodle simple plugin**](https://www.learningonthebeach.com/how-to-create-simple-block-plugin-in-moodle/ "How to create Moodle simple block plugin") 
* [**How to create Moodle tables with plugin**](https://www.learningonthebeach.com/how-to-create-tables-in-moodle-with-xmldb-editor/ "How to create tables in Moodle using plugin" )
* [**How to use Moodle block plugin for SQL output**](https://www.learningonthebeach.com/how-to-use-moodle-block-plugin-for-sql-output/ "How to use Moodle block plugin for SQL output")

The code contains both install.xml file and query used in the last video.



 
    

 
