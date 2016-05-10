php arcane summon:module Panel.Address --up id.pk \
											city.string.input \
											zipcode.string.input \
											state.string.input \
											neightborhood.string.input \
											location.string.input \
									 	 	--project Worknova 

php arcane summon:module  Panel.User --up id.pk \
									 	  facebook_id.int \
										  address_id.linked[Panel.Address.id] \
										  firstname.string.input[required] \
									 	  lastname.string.input[required] \
									 	  email.string.input[email required] \
									 	  active.bool \
									 	  --project Worknova

php arcane summon:module Panel.Profile --up id.pk \
											user_id.linked[Panel.User.id] \
									 	 	dob.date.datetime \
									 	 	photo.string
									 	 	job_title.string.input \
									 	 	startup_enable.bool \
									 	 	about.text.textarea \
									 	 	--project Worknova 

php arcane summon:module Panel.Opportunity --up id.pk \
												title.string.input[required]
												description.text.input \
												dt_created.datetime \
												active.bool \
												--project Worknova 

php arcane summon:module Panel.Startup --up id.pk \
											title.string.input[required]
											address_id.linked[Panel.Address.id]
											description.text.input \
											dt_created.datetime \
											active.bool \
											--project Worknova 


