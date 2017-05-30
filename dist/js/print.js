function printData()
{
   var divToPrint=document.getElementById("MonthyTable");
   newWin= window.open("");
   newWin.document.write(divToPrint.outerHTML);
   newWin.print();
   newWin.close();
}