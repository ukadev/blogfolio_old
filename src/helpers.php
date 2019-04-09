<?php

if (!function_exists('addDisqusBox')) {
    /**
     * Get the Disqus comments
     *
     */
    function addDisqusBox($url, $id, $disqus)
    {
        echo <<<EOF
            <div id="disqus_thread"></div>
            <script>
            /**
            *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
            *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables
            */
            
            var disqus_config = function () {
            this.page.url = "$url";
            this.page.identifier = $id;
            };
            
            (function() { // DON'T EDIT BELOW THIS LINE
            var d = document, s = d.createElement('script');
            s.src = '//$disqus/embed.js';
            s.setAttribute('data-timestamp', +new Date());
            (d.head || d.body).appendChild(s);
            })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
EOF;

    }
}

if (!function_exists('addDisqusCounter')) {
    /**
     * Get the Disqus js
     *
     */
    function addDisqusCounter($url)
    {
        echo <<<EOF
            <script id="dsq-count-scr" src="//$url/count.js" async></script>
EOF;

    }
}