#!/bin/bash
read -p "What is the file path? " FILEPATH
if [ "$FILEPATH" != "" ]; then
  
  # Make sure they want to do the action they are requesting #
  read -p "Are you sure you wish to commit and push $FILEPATH ? (y/n) " RUSURE
  if [ "$RUSURE" = "y" ]; then
  
  	read -p "Enter a commit message " COMMITMSG
  	if [ "$COMMITMSG" != "" ]; then
  
	  	# Add / Replace the file #
	  	git add $FILEPATH
	  	
	  	git commit -m '$COMMITMSG'
	 
	 	# Push the file #
	 	git push
	 	
 	else
  	echo "Please enter a valid commit message"
  	fi
  	
  else
  	echo "Commit and Push process has been terminated by the client"
  fi
  
else
  echo "Please enter a valid file name / path"
fi
