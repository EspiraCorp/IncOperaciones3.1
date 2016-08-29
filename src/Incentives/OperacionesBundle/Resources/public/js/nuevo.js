<script>
        // Get the div that holds the collection of addresses
        var collectionHolder = $('div.contactos');

        // setup an "add a address" link
        var $newLinkLi = $('<a href="#" class="btn"><i class="icon"></i> Añadir una dirección</a>');

        $(function(){

            // add the "add a address" anchor and li to the addresses div
            collectionHolder.parent().append($newLinkLi);

            // count the current form inputs we have (e.g. 2), use that as the new
            // index when inserting a new item (e.g. 2)
            collectionHolder.data('index', collectionHolder.find(':input').length);

            $newLinkLi.on('click', function(e) {
                // prevent the link from creating a "#" on the URL
                e.preventDefault();

                // add a new address form (see next code block)
                addTagForm(collectionHolder);
            });
        });


        function addTagForm(collectionHolder) {
            // Get the data-prototype explained earlier
            var prototype = collectionHolder.data('prototype');

            // get the new index
            var index = collectionHolder.data('index');

            // Replace '__name__' in the prototype's HTML to
            // instead be a number based on how many items we have
            var newForm = prototype.replace(/__name__/g, index);

            // increase the index with one for the next item
            collectionHolder.data('index', index + 1);

            // Display the form in the page in an li, before the "Add a address" link li
            var $newFormLi = $('<div></div>').append(newForm);
            collectionHolder.append($newFormLi);
        }



    </script>