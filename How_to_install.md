# Codeigniter-CRUD-without-page-load

How to install
--------------
1. unzip pack and put it in server public folder
2. edit baseurl in config file inside crud_application/config folder as base url
3. import database[crud_db.sql] found inside
4. configure database.php inside crud_application/config folder

To run 

goto url/administrator

username = shafeek/shafeek@sampledomain.in
password = shafeekb4u
it will go to employee management area

To test api use any REST API client like POSTMAN

2 API are there 
---------------
1. siteurl/api/all-employees method(get)

mandatory input parameters
Client-Service : api-client
Auth-Key : EmployeeapiKey

1. siteurl/api/single-employee/1(get)

mandatory input parameters
Client-Service : api-client
Auth-Key : EmployeeapiKey
