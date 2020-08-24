<form action="/customtemplates/" method="get">

	<input type="hidden" name="cat" value="4">
	<label for="search">Search</label>
	<input type="text" name="s" id="search" value="<?php the_search_query(); ?>" required>

	<button type="submit">Search Word(s)</button>


</form>