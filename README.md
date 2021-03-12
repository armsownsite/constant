# constant

Hi , 
At the first you must to create constant DB in your mysql , then restore Constant/constant.sql files
Then you need to move Constant/ folder to your web server:
In your Web Browser open http://localhost/Constant/

Great 

    To Create new folder , you must tap the right click and tap Create Button
    Unfortunetly You Can rename your created Folder After Refreshing the page.

     To Rename new folder , you must tap the right click and tap Renam Button
	dont forget to press save button after all;
	
     You can also drag and drop folders;
    


RESTAPI
	CREATE
	URL http://localhost/Constant/api/product/create.php
	POST	
		{
			"category_name":"Laptop",
			"catgeory_parent_id":"5"
		}

	UPDATE
	POST http://localhost/Constant/api/product/update.php
	POST	
		{
			"category_id":"2",
			"category_name":"Earphones",
			"category_parent_id":"5",
		}
	READ
	POST http://localhost/Constant/api/product/read.php
	GET	
	



:: I know that i could make it much more better : but it`s 06:35 AM : and i want to sleep ))