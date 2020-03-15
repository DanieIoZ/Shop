function Sort(SortingValue) {
	var ItemsSortInfo = '';

	switch(SortingValue)
	{
		case "Name":
			ItemsSortInfo = Array.from(document.getElementsByName("NameData"), x => x.innerHTML); 
			break;
		case "BtL":
			ItemsSortInfo = Array.from(document.getElementsByName("PriceData"), x => x.innerHTML); 
			break;
		case "LtB":
			ItemsSortInfo = Array.from(document.getElementsByName("PriceData"), x => x.innerHTML); 
			break;

	}

	

	try
	{
		$.ajax({
			url: "../sortingfunc.php",
			type: "POST",
			data:{
				'ItemsSortInfo': ItemsSortInfo, 
				'SortingValue': SortingValue
			},
			success: function(data){
				Items = document.getElementById('ItemsList').children;
				numbs = data.split(",");
				NewItems = Array.from(Items, x => x.innerHTML);
				for (var i = 0; i < numbs.length; i++) 
				{
					Items[i].innerHTML = NewItems[numbs[i]];
				}
			}
		});
	}
	catch(e)
	{

	}
}

