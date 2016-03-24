#!/bin/bash

php arcane summon:project Reps --template http://github.com/arcane/starters/dashboard   

php arcane summon:module Reps.WinterPanel.User              

php arcane summon:model ArcaneLabs.User.User  
    --up id.int.auto-increment.pk
         firstname.string
         lastname.string   
         email.string
         password.string 
         dt_create.datetime

php arcane summon:model ArcaneLabs.User

php arcane summon:model ArcaneLabs.User.Permission  
    --up id.int.auto-increment.pk


php arcane summon:model ArcaneLabs.User.Log  
    --up id.int.auto-increment.pk
         dt_create.datetime




php arcane summon:module Reps.HouseAd
    

php arcane summon:model Reps.HouseAd.Ad
    --up id.int.auto-increment.pk
         title.string
         description.text
         amount.money
         address.text
         state.char
         zipcode.string
         user_id.int.fk:User.Int
         type_id.int
         transaction_id.int
         dt_create.datetime
         dt_update.datetime


php arcane summon:model Reps.HouseAd.Type
    --up id.int.auto-increment.pk
         title.string
         description.text
         
php arcane summon:model Reps.HouseAd.Transaction
    --up id.int.auto-increment.pk
         title.string
         

php arcane summon:model Reps.HouseAd.Images
    --up id.int.auto-increment.pk
         ad_id.int
         order.int
         fullpath.string

php arcane summon:model Reps.HouseAd.Email
    --up id.int.auto-increment.pk
         event.string
         title.string
         body.string
