library(shiny)
library(stringdist)
library("networkD3")
library('randomNames') 
library("igraph")

dbDisconnectAll <- function(){
  ile <- length(dbListConnections(MySQL())  )
  lapply( dbListConnections(MySQL()), function(x) dbDisconnect(x) )
  cat(sprintf("%s connection(s) closed.\n", ile))
}
dbDisconnectAll()
mydb = dbConnect(MySQL(), user='root', password='', dbname='javagenie', host='localhost')
fulldb<-dbSendQuery(mydb, "select * from notessal ;")
alldata <- fetch(fulldb, n=-1)
ui <- fluidPage(
  
  titlePanel("My social graph"),
  
  fluidRow(
    column(8,    
           # h3("session$clientdata values"),
           # verbatimTextOutput("summary"),
           #h3("Parsed URL query string"),
           verbatimTextOutput("queryText"), 
          # h3("My Social Graph"),
           forceNetworkOutput("graph")
    )
  )
)


server <- function(input, output, session)
{

  
  output$graph <- renderForceNetwork({  
    query <- parseQueryString(session$clientData$url_search)
    # Return a string with key-value pairs
    #paste( query, sep = "=", collapse=", ")
    
    rs <- dbSendQuery(mydb, paste("select * from notessal where uid='",as.numeric(query),"';"))
    data = fetch(rs, n=-1)
    users <- data.frame(unique(unlist(alldata$UID)))
    ulevel <- numeric(nrow(users))
    
    #for(i in 1:nrow(users))
    #{
     # lev <- as.numeric(fetch(dbSendQuery(mydb, paste("select nlevel from notessal where uid='",users[i,],"';")), n=-1))
    #  ulevel[i] <- lev
    #}
    usersim <- numeric(nrow(users))
    for(i in 1:nrow(users))
    {
      usernotes <- dbSendQuery(mydb, paste("select * from notessal where uid='",users[i,],"';"))
      unotes <- fetch(usernotes, n=-1)
      
      sim <- 0
      for(j in 1:nrow(data))
      {
        for(k in 1:nrow(unotes))
        {
          sim <- sim + stringdist(data$topic[j], unotes$topic[k], method="cosine")
        }
        
      }
      usersim[i] <- sim/(nrow(data)*nrow(unotes))
    }
    
    users$userlevel <-sample(3, size = nrow(users), replace = TRUE)

    relations <- data.frame(source=as.numeric(query), target=unique(alldata$uid), value = NA)
    vertices<-data.frame("name" = unique(unlist(relations)) ) # node names
    vertices <- na.omit(vertices)
    
    g <- graph.data.frame(relations, directed=T, vertices=vertices) # raw graph
    #vertices$group = edge.betweenness.community(g)$membership
    vertices$group = users$userlevel
    relations$source.index = match(relations$source, vertices$name)-1
    relations$target.index = match(relations$target, vertices$name)-1
    relations$value <- usersim
    
    MyClickScript <- 'alert("You clicked " + d.name + " which is in row " +
    (d.index + 1) +  " of your original R data frame");'
    
    ColourScale <- 'd3.scale.ordinal()
    .domain([0, 1, 2])
    .range(["#FF6900", "#694489", "#784489"]);'
    
    
    forceNetwork(Links = relations, Nodes = vertices ,
                 Source = "source.index", Target = "target.index", Value = "value",
                 NodeID = "name",
                 Group = "group", # color nodes by betweeness calculated earlier
                 #colourScale = users$userlevel,
                 charge = -70, # node repulsion
                 linkDistance = JS("function(d){return d.value * 100}"),
                 #radiusCalculation = JS("d.level*10"),
                 zoom = T, clickAction = MyClickScript, legend=TRUE )
    
  })
  
  
  list_to_string <- function(obj, listname) {
    if (is.null(names(obj))) {
      paste(listname, "[[", seq_along(obj), "]] = ", obj,
            sep = "", collapse = "\n")
    } else {
      paste(listname, "$", names(obj), " = ", obj,
            sep = "", collapse = "\n")
    }
  }
  
}

#dbDisconnect(mydb)

shinyApp(ui=ui, server=server)


