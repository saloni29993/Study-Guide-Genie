import os
for filename in os.listdir("C:\\Users\\kashyap\\Desktop\\aww\\scraper - python\\scraper-data"):
	#print filename
	f = open("scraper-data/"+filename)
	contents = f.read()
	f.close()
	new_contents = contents.replace('\n', '')
	f = open('output.txt', 'w')
	f.write(new_contents)
	f.close()
	print "done...",filename