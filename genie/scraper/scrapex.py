from bs4 import BeautifulSoup
import sys
import os

import requests



u = "https://en.wikibooks.org/wiki/Java_Programming"

r = requests.get(u)

data=r.text

soup = BeautifulSoup(data,"html5lib")

# body = soup.find("div","mw-content-ltr")
linklist = {}

# for b in body:
xlist= soup.findAll('ul',limit=11);
for x in xlist:
		links = x.findAll('a')
		for a in links:
			if not a.find(class_="noprint"):
				linklist[a.text] = a.get('href')

list_links = []
list_pages = []

del linklist[""]

del linklist["Traffic"]
del linklist["Recent changes"]
del linklist["Keywords"]
del linklist["If you are interested in editing this book"]

finallinks =""
counter = 0
for l in linklist:
 	#print l," --> ",linklist[l]

	#print linklist

	url = "https://en.wikibooks.org" +linklist[l]

	#print "visiting... " ,l

	#url = "https://en.wikibooks.org/wiki/Java_Programming/Statements"

	r = requests.get(url)

	data=r.text

	soup = BeautifulSoup(data,"html.parser")


	main_file = soup.find("h1").text.encode('ascii', 'ignore').replace("/","")

	#print "h1: ",main_file.replace("/","")

	content = soup.find("div","mw-content-ltr")

	#print content

	description = ""

	bache = content.contents

	for bacha in bache:
		if bacha.name == "p":
			description += bacha.text.encode('ascii', 'ignore')
		if bacha.name == "h2":
			break

	#print description

	###############################################
	# # Open a file
	# fo = open(main_file +".txt", "wb")
	# fo.write( description.encode('ascii', 'ignore'));
	# # Close opend file
	# fo.close()
	###############################################

	para = content.find("p")

	ptext = ""

	for section in content.findAll('h2'):
		ptext = ""
		nextNode = section.nextSibling
		subfile = section.contents[0].text.encode('ascii', 'ignore')
		link_to_id = section.contents[0]['id']

		#finallinks += "'" +url +"#" +link_to_id +"',"
		print "h2: ",subfile
		print "id: ",link_to_id

		#finallinks += "'" +main_file +" - " +subfile +".txt'," 
		counter = counter + 1
		try:
			while True:
				nextNode = nextNode.nextSibling
				try:
					tag_name = nextNode.name
					#print tag_name
				except AttributeError:
					tag_name = ""
					#print tag_name

				if tag_name == "p":
					ptext += nextNode.text

				if tag_name == "h2":
					#print "*****\n"
					break
				if tag_name == "noscript":
					#print "*****\n"
					break

			#print ptext.encode('ascii', 'ignore'),"\n"
			###############################################
			# # Open a file
			# fo = open(main_file +" - " +subfile +".txt", "wb")
			# fo.write( ptext.encode('ascii', 'ignore'));
			# # Close opend file
			# fo.close()
			###############################################

		except Exception, e:
			continue


		