# jxOrderFields #

OXID eShop Extension for Supporting more fields in oxOrderArticles


## Setup ##

1. Unzip the complete file with all the folder structures and upload the content of the folder copy_this to the root folder of your shop.
2. In the admin backend of the shop go to _Extensions_ - _Modules_. Select the module _jxOrderFields_.
3. First switch to the tab _Settings_ and enter these fields  (one in each line) from oxarticles you want to transfer additionally to oxorderarticles on each sale and save the settings. `Activate` the module now.    
If you later add more fields to the settings, you have to `Deactivate` the module once and `Activate` it again for checking and creating the new database fields.
4. As an alternative method to the automatically created fields, you can create the additional database fields in the table oxorderarticles manually, but with the prefix jx instead of ox.

### Way of Field Creation ###
The fields, defined in the settings, will be created in the table oxorderarticles during the module activation if they don't exist. To avoid conflicts, the prefix _ox_ will be removed and replaced by the prefix _jx_. 

#### Examples ####
_oxorder_.oxean --> _oxorderarticles_.jxean  
_oxorder_.oxvendorid --> _oxorderarticles_.jxvendorid

#### Hints ####  
  * Later changes (eg. larger field) made on the original fields will be not handled by the module.
  * The activation events works as well for the built-in fields as for custom fields.
  
## Screenshots ##

tbd ...