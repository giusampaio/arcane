php arcane summon:project Manager  

php arcane summon:module Agencia110.User --project Manager

php arcane summon:crud Agencia110.User.Info  --project Manager 
    --up id.primary
         firstname.string  
         lastname.string
         facebook_id.int    
         google_id.int  
         twiter_id.int  
         dt_create.datetime

php arcane summon:crud Agencia110.User.Permission 
    --project CMS,API,Site 
    --up id.primary
         entity.string  
         read.string
         write.string

php arcane summon:crud Agencia110.User.Log 
    --project CMS,API,Site 
    --up id.primary
         user_id.int  
         dt_create.datetime
         dt_update.datetime



php arcane summon:module Agencia110.Girl --project Manager

php arcane summon:crud Agencia110.Girl.Info 
    --project Manager 
    --up id.primary
         name.string  
         description.string
         skin.string
         hair.string
         phone.string
         dt_created
 
php arcane summon:crud Agencia110.Girl.Image 
    --project Manager
    --up id.primary
         ad_id.int
         order.int
         path.string
  
php arcane summon:crud Agencia110.Girl.Email 
    --project Manager
    --up id.primary
         event.string
         title.string
         template.text



