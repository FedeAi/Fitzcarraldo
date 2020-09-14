<% 
filecontatore= server.MapPath("cgi-bin/public/contatore.txt")

Set fs = CreateObject("Scripting.FileSystemObject")
Set apro = fs.OpenTextFile(filecontatore)
quanti = Clng(apro.ReadLine)
quanti = quanti + 1
apro.close

Set apro = fs.CreateTextFile(filecontatore,True)
apro.WriteLine(quanti)
apro.Close
%>
document. write ("<font face=Verdana size=1 color=#999999>visitatore n° <% =quanti %> dal 
19.03.2007")