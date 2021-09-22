
window.projectVersion = 'master';

(function(root) {

    var bhIndex = null;
    var rootPath = '';
    var treeHtml = '        <ul>                <li data-name="namespace:phpowermove" class="opened">                    <div style="padding-left:0px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="phpowermove.html">phpowermove</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:phpowermove_docblock" class="opened">                    <div style="padding-left:18px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="phpowermove/docblock.html">docblock</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="namespace:phpowermove_docblock_tags" >                    <div style="padding-left:36px" class="hd">                        <span class="glyphicon glyphicon-play"></span><a href="phpowermove/docblock/tags.html">tags</a>                    </div>                    <div class="bd">                                <ul>                <li data-name="class:phpowermove_docblock_tags_DeprecatedTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/DeprecatedTag.html">DeprecatedTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_MethodTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/MethodTag.html">MethodTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_ParamTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/ParamTag.html">ParamTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_PropertyReadTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/PropertyReadTag.html">PropertyReadTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_PropertyTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/PropertyTag.html">PropertyTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_PropertyWriteTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/PropertyWriteTag.html">PropertyWriteTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_ReturnTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/ReturnTag.html">ReturnTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_SinceTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/SinceTag.html">SinceTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_TagFactory" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/TagFactory.html">TagFactory</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_ThrowsTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/ThrowsTag.html">ThrowsTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_TypeTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/TypeTag.html">TypeTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_UnknownTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/UnknownTag.html">UnknownTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_VarTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/VarTag.html">VarTag</a>                    </div>                </li>                            <li data-name="class:phpowermove_docblock_tags_VersionTag" >                    <div style="padding-left:62px" class="hd leaf">                        <a href="phpowermove/docblock/tags/VersionTag.html">VersionTag</a>                    </div>                </li>                </ul></div>                </li>                            <li data-name="class:phpowermove_docblock_TagNameComparator" >                    <div style="padding-left:44px" class="hd leaf">                        <a href="phpowermove/docblock/TagNameComparator.html">TagNameComparator</a>                    </div>                </li>                </ul></div>                </li>                </ul></div>                </li>                </ul>';

    var searchTypeClasses = {
        'Namespace': 'label-default',
        'Class': 'label-info',
        'Interface': 'label-primary',
        'Trait': 'label-success',
        'Method': 'label-danger',
        '_': 'label-warning'
    };

    var searchIndex = [
                    
            {"type": "Namespace", "link": "phpowermove.html", "name": "phpowermove", "doc": "Namespace phpowermove"},{"type": "Namespace", "link": "phpowermove/docblock.html", "name": "phpowermove\\docblock", "doc": "Namespace phpowermove\\docblock"},{"type": "Namespace", "link": "phpowermove/docblock/tags.html", "name": "phpowermove\\docblock\\tags", "doc": "Namespace phpowermove\\docblock\\tags"},
            
            {"type": "Class", "fromName": "phpowermove\\docblock", "fromLink": "phpowermove/docblock.html", "link": "phpowermove/docblock/TagNameComparator.html", "name": "phpowermove\\docblock\\TagNameComparator", "doc": "&quot;&quot;"},
                                                        {"type": "Method", "fromName": "phpowermove\\docblock\\TagNameComparator", "fromLink": "phpowermove/docblock/TagNameComparator.html", "link": "phpowermove/docblock/TagNameComparator.html#method_compare", "name": "phpowermove\\docblock\\TagNameComparator::compare", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/DeprecatedTag.html", "name": "phpowermove\\docblock\\tags\\DeprecatedTag", "doc": "&quot;Represents the &lt;code&gt;@deprecated&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/MethodTag.html", "name": "phpowermove\\docblock\\tags\\MethodTag", "doc": "&quot;Represents the &lt;code&gt;@method&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/ParamTag.html", "name": "phpowermove\\docblock\\tags\\ParamTag", "doc": "&quot;Represents the &lt;code&gt;@param&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/PropertyReadTag.html", "name": "phpowermove\\docblock\\tags\\PropertyReadTag", "doc": "&quot;Represents the &lt;code&gt;@property-read&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/PropertyTag.html", "name": "phpowermove\\docblock\\tags\\PropertyTag", "doc": "&quot;Represents the &lt;code&gt;@property&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/PropertyWriteTag.html", "name": "phpowermove\\docblock\\tags\\PropertyWriteTag", "doc": "&quot;Represents the &lt;code&gt;@property-write&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/ReturnTag.html", "name": "phpowermove\\docblock\\tags\\ReturnTag", "doc": "&quot;Represents the &lt;code&gt;@return&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/SinceTag.html", "name": "phpowermove\\docblock\\tags\\SinceTag", "doc": "&quot;Represents the &lt;code&gt;@since&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/TagFactory.html", "name": "phpowermove\\docblock\\tags\\TagFactory", "doc": "&quot;Tag Factory&quot;"},
                                                        {"type": "Method", "fromName": "phpowermove\\docblock\\tags\\TagFactory", "fromLink": "phpowermove/docblock/tags/TagFactory.html", "link": "phpowermove/docblock/tags/TagFactory.html#method_create", "name": "phpowermove\\docblock\\tags\\TagFactory::create", "doc": "&quot;Creates a new tag instance on the given name&quot;"},
            
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/ThrowsTag.html", "name": "phpowermove\\docblock\\tags\\ThrowsTag", "doc": "&quot;Represents the &lt;code&gt;@throws&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/TypeTag.html", "name": "phpowermove\\docblock\\tags\\TypeTag", "doc": "&quot;Represents the &lt;code&gt;@type&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/UnknownTag.html", "name": "phpowermove\\docblock\\tags\\UnknownTag", "doc": "&quot;Represents an unknown tag.&quot;"},
                                                        {"type": "Method", "fromName": "phpowermove\\docblock\\tags\\UnknownTag", "fromLink": "phpowermove/docblock/tags/UnknownTag.html", "link": "phpowermove/docblock/tags/UnknownTag.html#method_parse", "name": "phpowermove\\docblock\\tags\\UnknownTag::parse", "doc": "&quot;&quot;"},
                    {"type": "Method", "fromName": "phpowermove\\docblock\\tags\\UnknownTag", "fromLink": "phpowermove/docblock/tags/UnknownTag.html", "link": "phpowermove/docblock/tags/UnknownTag.html#method_toString", "name": "phpowermove\\docblock\\tags\\UnknownTag::toString", "doc": "&quot;&quot;"},
            
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/VarTag.html", "name": "phpowermove\\docblock\\tags\\VarTag", "doc": "&quot;Represents the &lt;code&gt;@var&lt;\/code&gt; tag.&quot;"},
                    
            {"type": "Class", "fromName": "phpowermove\\docblock\\tags", "fromLink": "phpowermove/docblock/tags.html", "link": "phpowermove/docblock/tags/VersionTag.html", "name": "phpowermove\\docblock\\tags\\VersionTag", "doc": "&quot;Represents the &lt;code&gt;@version&lt;\/code&gt; tag.&quot;"},
                    
            
                                        // Fix trailing commas in the index
        {}
    ];

    /** Tokenizes strings by namespaces and functions */
    function tokenizer(term) {
        if (!term) {
            return [];
        }

        var tokens = [term];
        var meth = term.indexOf('::');

        // Split tokens into methods if "::" is found.
        if (meth > -1) {
            tokens.push(term.substr(meth + 2));
            term = term.substr(0, meth - 2);
        }

        // Split by namespace or fake namespace.
        if (term.indexOf('\\') > -1) {
            tokens = tokens.concat(term.split('\\'));
        } else if (term.indexOf('_') > 0) {
            tokens = tokens.concat(term.split('_'));
        }

        // Merge in splitting the string by case and return
        tokens = tokens.concat(term.match(/(([A-Z]?[^A-Z]*)|([a-z]?[^a-z]*))/g).slice(0,-1));

        return tokens;
    };

    root.Sami = {
        /**
         * Cleans the provided term. If no term is provided, then one is
         * grabbed from the query string "search" parameter.
         */
        cleanSearchTerm: function(term) {
            // Grab from the query string
            if (typeof term === 'undefined') {
                var name = 'search';
                var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
                var results = regex.exec(location.search);
                if (results === null) {
                    return null;
                }
                term = decodeURIComponent(results[1].replace(/\+/g, " "));
            }

            return term.replace(/<(?:.|\n)*?>/gm, '');
        },

        /** Searches through the index for a given term */
        search: function(term) {
            // Create a new search index if needed
            if (!bhIndex) {
                bhIndex = new Bloodhound({
                    limit: 500,
                    local: searchIndex,
                    datumTokenizer: function (d) {
                        return tokenizer(d.name);
                    },
                    queryTokenizer: Bloodhound.tokenizers.whitespace
                });
                bhIndex.initialize();
            }

            results = [];
            bhIndex.get(term, function(matches) {
                results = matches;
            });

            if (!rootPath) {
                return results;
            }

            // Fix the element links based on the current page depth.
            return $.map(results, function(ele) {
                if (ele.link.indexOf('..') > -1) {
                    return ele;
                }
                ele.link = rootPath + ele.link;
                if (ele.fromLink) {
                    ele.fromLink = rootPath + ele.fromLink;
                }
                return ele;
            });
        },

        /** Get a search class for a specific type */
        getSearchClass: function(type) {
            return searchTypeClasses[type] || searchTypeClasses['_'];
        },

        /** Add the left-nav tree to the site */
        injectApiTree: function(ele) {
            ele.html(treeHtml);
        }
    };

    $(function() {
        // Modify the HTML to work correctly based on the current depth
        rootPath = $('body').attr('data-root-path');
        treeHtml = treeHtml.replace(/href="/g, 'href="' + rootPath);
        Sami.injectApiTree($('#api-tree'));
    });

    return root.Sami;
})(window);

$(function() {

    // Enable the version switcher
    $('#version-switcher').change(function() {
        window.location = $(this).val()
    });

    
        // Toggle left-nav divs on click
        $('#api-tree .hd span').click(function() {
            $(this).parent().parent().toggleClass('opened');
        });

        // Expand the parent namespaces of the current page.
        var expected = $('body').attr('data-name');

        if (expected) {
            // Open the currently selected node and its parents.
            var container = $('#api-tree');
            var node = $('#api-tree li[data-name="' + expected + '"]');
            // Node might not be found when simulating namespaces
            if (node.length > 0) {
                node.addClass('active').addClass('opened');
                node.parents('li').addClass('opened');
                var scrollPos = node.offset().top - container.offset().top + container.scrollTop();
                // Position the item nearer to the top of the screen.
                scrollPos -= 200;
                container.scrollTop(scrollPos);
            }
        }

    
    
        var form = $('#search-form .typeahead');
        form.typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'search',
            displayKey: 'name',
            source: function (q, cb) {
                cb(Sami.search(q));
            }
        });

        // The selection is direct-linked when the user selects a suggestion.
        form.on('typeahead:selected', function(e, suggestion) {
            window.location = suggestion.link;
        });

        // The form is submitted when the user hits enter.
        form.keypress(function (e) {
            if (e.which == 13) {
                $('#search-form').submit();
                return true;
            }
        });

    
});


