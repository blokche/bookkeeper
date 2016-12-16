var RandomQuotes = {
    
    quotes:[
        {
            quote:"Chaque lecture est un acte de résistance. Une lecture bien menée sauve de tout, y compris de soi-même.",
            author:"Daniel Pennac",
            book:"Comme Un Roman"
        },
        {
            quote:"La vraie lecture commence quand on ne lit plus seulement pour se distraire et se fuir, mais pour se trouver.",
            author:"Jean Guéhenno",
            book:"Carnets du Viel Écrivain"
        },
        {
            quote:"Le temps de lire, comme le temps d'aimer, dilate le temps de vivre.",
            author:"Daniel Pennac",
            book:"Comme Un Roman"
        },
        {
            quote:"Lire, c'est boire et manger. L'esprit qui ne lit pas maigrit comme le corps qui ne mange pas.",
            author:"Victor Hugo",
            book:null
        },
        {
            quote:"Lire est le seul moyen de vivre plusieurs fois.",
            author:"Pierre Dumayet",
            book:null
        },
        {
            quote:"La lecture d'un roman jette sur la vie une lumière.",
            author:"Louis Aragon",
            book:null
        },
        {
            quote:"Je n'ai jamais eu de chagrin qu'une heure de lecture n'ait dissipé.",
            author:"Montesquieu",
            book:null
        },
        {
            quote:"Les gens sont les mêmes dans la lecture que dans la vie : égoïstes, avides de plaisir et inéducables.",
            author:"Amélie Nothomb",
            book:"Les Combustibles"
        }
    ],

    getQuote: function () {
        return this.quotes[Math.floor(this.quotes.length * Math.random())]
    },

    generateRandomQuote:function (element) 
    {
        var container = document.querySelector(element);
        var blockquote = document.createElement('blockquote');
        blockquote.classList.add("blockquote");
        var citationParagraph = document.createElement('p');
        var citationFooter = document.createElement('footer');
        var quote = this.getQuote();
        
        citationFooter.innerHTML = "<span class='quote_author'>"+quote.author+"</span>";
        if (quote.book !== null) {
            citationFooter.innerHTML += "<br /><span class='quote_book'>"+quote.book+"</span>"
        }
        citationParagraph.innerHTML = quote.quote;

        blockquote.appendChild(citationParagraph);
        blockquote.appendChild(citationFooter);
        container.appendChild(blockquote);
    }
}