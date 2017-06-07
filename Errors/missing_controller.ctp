<section class="missing-controller-area">
    <div class="container">
        <div class="page-error">
            <h3>
                Ups.. Wystąpił błąd. Spróbuj ponownie .
                <br/>
                Jeżeli to nie pomoże skontaktuj się z nami
            </h3>
            <i class="fa fa-exclamation-triangle error-icon"></i>
        </div>


        <script>
            $(document).ready(function () {
                $(".error-icon").on('click', function () {
                    $(".error-area").slideDown(400);
                });
            });

        </script>

        <div style="display: none" class="error-area">


            <h2>Missing Controller</h2>

            <p class="error">
                <strong>Error: </strong>
                <em>XosController</em> could not be found.</p>

            <p class="error">
                <strong>Error: </strong>
                Create the class <em>XosController</em> below in file: greencook/Controller/XosController.php</p>
<pre>&lt;?php
class XosController extends AppController {

}
</pre>
            <p class="notice">
                <strong>Notice: </strong>
                If you want to customize this error message, create greencook/View/Errors/missing_controller.ctp</p>

            <h3>Stack Trace</h3>
            <ul class="cake-stack-trace">
                <li><a href="#" onclick="traceToggle(event, 'file-excerpt-0')">APP/webroot/index.php line 111</a> →
                    <a href="#" onclick="traceToggle(event, 'trace-args-0')">Dispatcher-&gt;dispatch(CakeRequest,
                        CakeResponse)</a>

                    <div id="file-excerpt-0" class="cake-code-dump" style="display:none;"><pre><code><span
                                    style="color: #000000"><span style="color: #0000BB">$Dispatcher</span><span
                                        style="color: #007700">-&gt;</span><span
                                        style="color: #0000BB">dispatch</span><span
                                        style="color: #007700">(</span></span></code>
<code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="color: #007700">new&nbsp;</span><span style="color: #0000BB">CakeRequest</span><span
            style="color: #007700">(),</span></span></code>
<code><span style="color: #000000"><span style="color: #0000BB">&nbsp;&nbsp;&nbsp;&nbsp;</span><span
            style="color: #007700">new&nbsp;</span><span style="color: #0000BB">CakeResponse</span><span
            style="color: #007700">()</span></span></code>
<span class="code-highlight"><code><span style="color: #000000"><span style="color: #0000BB"></span><span
                style="color: #007700">);</span></span></code></span>
<code><span style="color: #000000"><span style="color: #0000BB"></span></span></code></pre>
                    </div>
                    <div id="trace-args-0" class="cake-code-dump" style="display: none;"><pre>object(CakeRequest) {
	params =&gt; array(
		'plugin' =&gt; null,
		'controller' =&gt; 'xos',
		'action' =&gt; 'index',
		'named' =&gt; array(),
		'pass' =&gt; array()
	)
	data =&gt; array()
	query =&gt; array()
	url =&gt; 'xos'
	base =&gt; ''
	webroot =&gt; '/'
	here =&gt; '/xos'
	[protected] _detectors =&gt; array(
		'get' =&gt; array(
			'env' =&gt; 'REQUEST_METHOD',
			'value' =&gt; 'GET'
		),
		'post' =&gt; array(
			'env' =&gt; 'REQUEST_METHOD',
			'value' =&gt; 'POST'
		),
		'put' =&gt; array(
			'env' =&gt; 'REQUEST_METHOD',
			'value' =&gt; 'PUT'
		),
		'delete' =&gt; array(
			'env' =&gt; 'REQUEST_METHOD',
			'value' =&gt; 'DELETE'
		),
		'head' =&gt; array(
			'env' =&gt; 'REQUEST_METHOD',
			'value' =&gt; 'HEAD'
		),
		'options' =&gt; array(
			'env' =&gt; 'REQUEST_METHOD',
			'value' =&gt; 'OPTIONS'
		),
		'ssl' =&gt; array(
			'env' =&gt; 'HTTPS',
			'value' =&gt; (int) 1
		),
		'ajax' =&gt; array(
			'env' =&gt; 'HTTP_X_REQUESTED_WITH',
			'value' =&gt; 'XMLHttpRequest'
		),
		'flash' =&gt; array(
			'env' =&gt; 'HTTP_USER_AGENT',
			'pattern' =&gt; '/^(Shockwave|Adobe) Flash/'
		),
		'mobile' =&gt; array(
			'env' =&gt; 'HTTP_USER_AGENT',
			'options' =&gt; array(
				[maximum depth reached]
			)
		),
		'requested' =&gt; array(
			'param' =&gt; 'requested',
			'value' =&gt; (int) 1
		),
		'json' =&gt; array(
			'accept' =&gt; array(
				[maximum depth reached]
			),
			'param' =&gt; 'ext',
			'value' =&gt; 'json'
		),
		'xml' =&gt; array(
			'accept' =&gt; array(
				[maximum depth reached]
			),
			'param' =&gt; 'ext',
			'value' =&gt; 'xml'
		)
	)
	[protected] _input =&gt; ''
}
object(CakeResponse) {
	[protected] _statusCodes =&gt; array(
		(int) 100 =&gt; 'Continue',
		(int) 101 =&gt; 'Switching Protocols',
		(int) 200 =&gt; 'OK',
		(int) 201 =&gt; 'Created',
		(int) 202 =&gt; 'Accepted',
		(int) 203 =&gt; 'Non-Authoritative Information',
		(int) 204 =&gt; 'No Content',
		(int) 205 =&gt; 'Reset Content',
		(int) 206 =&gt; 'Partial Content',
		(int) 300 =&gt; 'Multiple Choices',
		(int) 301 =&gt; 'Moved Permanently',
		(int) 302 =&gt; 'Found',
		(int) 303 =&gt; 'See Other',
		(int) 304 =&gt; 'Not Modified',
		(int) 305 =&gt; 'Use Proxy',
		(int) 307 =&gt; 'Temporary Redirect',
		(int) 400 =&gt; 'Bad Request',
		(int) 401 =&gt; 'Unauthorized',
		(int) 402 =&gt; 'Payment Required',
		(int) 403 =&gt; 'Forbidden',
		(int) 404 =&gt; 'Not Found',
		(int) 405 =&gt; 'Method Not Allowed',
		(int) 406 =&gt; 'Not Acceptable',
		(int) 407 =&gt; 'Proxy Authentication Required',
		(int) 408 =&gt; 'Request Time-out',
		(int) 409 =&gt; 'Conflict',
		(int) 410 =&gt; 'Gone',
		(int) 411 =&gt; 'Length Required',
		(int) 412 =&gt; 'Precondition Failed',
		(int) 413 =&gt; 'Request Entity Too Large',
		(int) 414 =&gt; 'Request-URI Too Large',
		(int) 415 =&gt; 'Unsupported Media Type',
		(int) 416 =&gt; 'Requested range not satisfiable',
		(int) 417 =&gt; 'Expectation Failed',
		(int) 429 =&gt; 'Too Many Requests',
		(int) 500 =&gt; 'Internal Server Error',
		(int) 501 =&gt; 'Not Implemented',
		(int) 502 =&gt; 'Bad Gateway',
		(int) 503 =&gt; 'Service Unavailable',
		(int) 504 =&gt; 'Gateway Time-out',
		(int) 505 =&gt; 'Unsupported Version'
	)
	[protected] _mimeTypes =&gt; array(
		'html' =&gt; array(
			(int) 0 =&gt; 'text/html',
			(int) 1 =&gt; '*/*'
		),
		'json' =&gt; 'application/json',
		'xml' =&gt; array(
			(int) 0 =&gt; 'application/xml',
			(int) 1 =&gt; 'text/xml'
		),
		'rss' =&gt; 'application/rss+xml',
		'ai' =&gt; 'application/postscript',
		'bcpio' =&gt; 'application/x-bcpio',
		'bin' =&gt; 'application/octet-stream',
		'ccad' =&gt; 'application/clariscad',
		'cdf' =&gt; 'application/x-netcdf',
		'class' =&gt; 'application/octet-stream',
		'cpio' =&gt; 'application/x-cpio',
		'cpt' =&gt; 'application/mac-compactpro',
		'csh' =&gt; 'application/x-csh',
		'csv' =&gt; array(
			(int) 0 =&gt; 'text/csv',
			(int) 1 =&gt; 'application/vnd.ms-excel'
		),
		'dcr' =&gt; 'application/x-director',
		'dir' =&gt; 'application/x-director',
		'dms' =&gt; 'application/octet-stream',
		'doc' =&gt; 'application/msword',
		'docx' =&gt; 'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
		'drw' =&gt; 'application/drafting',
		'dvi' =&gt; 'application/x-dvi',
		'dwg' =&gt; 'application/acad',
		'dxf' =&gt; 'application/dxf',
		'dxr' =&gt; 'application/x-director',
		'eot' =&gt; 'application/vnd.ms-fontobject',
		'eps' =&gt; 'application/postscript',
		'exe' =&gt; 'application/octet-stream',
		'ez' =&gt; 'application/andrew-inset',
		'flv' =&gt; 'video/x-flv',
		'gtar' =&gt; 'application/x-gtar',
		'gz' =&gt; 'application/x-gzip',
		'bz2' =&gt; 'application/x-bzip',
		'7z' =&gt; 'application/x-7z-compressed',
		'hdf' =&gt; 'application/x-hdf',
		'hqx' =&gt; 'application/mac-binhex40',
		'ico' =&gt; 'image/x-icon',
		'ips' =&gt; 'application/x-ipscript',
		'ipx' =&gt; 'application/x-ipix',
		'js' =&gt; 'application/javascript',
		'latex' =&gt; 'application/x-latex',
		'lha' =&gt; 'application/octet-stream',
		'lsp' =&gt; 'application/x-lisp',
		'lzh' =&gt; 'application/octet-stream',
		'man' =&gt; 'application/x-troff-man',
		'me' =&gt; 'application/x-troff-me',
		'mif' =&gt; 'application/vnd.mif',
		'ms' =&gt; 'application/x-troff-ms',
		'nc' =&gt; 'application/x-netcdf',
		'oda' =&gt; 'application/oda',
		'otf' =&gt; 'font/otf',
		'pdf' =&gt; 'application/pdf',
		'pgn' =&gt; 'application/x-chess-pgn',
		'pot' =&gt; 'application/vnd.ms-powerpoint',
		'pps' =&gt; 'application/vnd.ms-powerpoint',
		'ppt' =&gt; 'application/vnd.ms-powerpoint',
		'pptx' =&gt; 'application/vnd.openxmlformats-officedocument.presentationml.presentation',
		'ppz' =&gt; 'application/vnd.ms-powerpoint',
		'pre' =&gt; 'application/x-freelance',
		'prt' =&gt; 'application/pro_eng',
		'ps' =&gt; 'application/postscript',
		'roff' =&gt; 'application/x-troff',
		'scm' =&gt; 'application/x-lotusscreencam',
		'set' =&gt; 'application/set',
		'sh' =&gt; 'application/x-sh',
		'shar' =&gt; 'application/x-shar',
		'sit' =&gt; 'application/x-stuffit',
		'skd' =&gt; 'application/x-koan',
		'skm' =&gt; 'application/x-koan',
		'skp' =&gt; 'application/x-koan',
		'skt' =&gt; 'application/x-koan',
		'smi' =&gt; 'application/smil',
		'smil' =&gt; 'application/smil',
		'sol' =&gt; 'application/solids',
		'spl' =&gt; 'application/x-futuresplash',
		'src' =&gt; 'application/x-wais-source',
		'step' =&gt; 'application/STEP',
		'stl' =&gt; 'application/SLA',
		'stp' =&gt; 'application/STEP',
		'sv4cpio' =&gt; 'application/x-sv4cpio',
		'sv4crc' =&gt; 'application/x-sv4crc',
		'svg' =&gt; 'image/svg+xml',
		'svgz' =&gt; 'image/svg+xml',
		'swf' =&gt; 'application/x-shockwave-flash',
		't' =&gt; 'application/x-troff',
		'tar' =&gt; 'application/x-tar',
		'tcl' =&gt; 'application/x-tcl',
		'tex' =&gt; 'application/x-tex',
		'texi' =&gt; 'application/x-texinfo',
		'texinfo' =&gt; 'application/x-texinfo',
		'tr' =&gt; 'application/x-troff',
		'tsp' =&gt; 'application/dsptype',
		'ttc' =&gt; 'font/ttf',
		'ttf' =&gt; 'font/ttf',
		'unv' =&gt; 'application/i-deas',
		'ustar' =&gt; 'application/x-ustar',
		'vcd' =&gt; 'application/x-cdlink',
		'vda' =&gt; 'application/vda',
		'xlc' =&gt; 'application/vnd.ms-excel',
		'xll' =&gt; 'application/vnd.ms-excel',
		'xlm' =&gt; 'application/vnd.ms-excel',
		'xls' =&gt; 'application/vnd.ms-excel',
		'xlsx' =&gt; 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
		'xlw' =&gt; 'application/vnd.ms-excel',
		'zip' =&gt; 'application/zip',
		'aif' =&gt; 'audio/x-aiff',
		'aifc' =&gt; 'audio/x-aiff',
		'aiff' =&gt; 'audio/x-aiff',
		'au' =&gt; 'audio/basic',
		'kar' =&gt; 'audio/midi',
		'mid' =&gt; 'audio/midi',
		'midi' =&gt; 'audio/midi',
		'mp2' =&gt; 'audio/mpeg',
		'mp3' =&gt; 'audio/mpeg',
		'mpga' =&gt; 'audio/mpeg',
		'ogg' =&gt; 'audio/ogg',
		'oga' =&gt; 'audio/ogg',
		'spx' =&gt; 'audio/ogg',
		'ra' =&gt; 'audio/x-realaudio',
		'ram' =&gt; 'audio/x-pn-realaudio',
		'rm' =&gt; 'audio/x-pn-realaudio',
		'rpm' =&gt; 'audio/x-pn-realaudio-plugin',
		'snd' =&gt; 'audio/basic',
		'tsi' =&gt; 'audio/TSP-audio',
		'wav' =&gt; 'audio/x-wav',
		'aac' =&gt; 'audio/aac',
		'asc' =&gt; 'text/plain',
		'c' =&gt; 'text/plain',
		'cc' =&gt; 'text/plain',
		'css' =&gt; 'text/css',
		'etx' =&gt; 'text/x-setext',
		'f' =&gt; 'text/plain',
		'f90' =&gt; 'text/plain',
		'h' =&gt; 'text/plain',
		'hh' =&gt; 'text/plain',
		'htm' =&gt; array(
			(int) 0 =&gt; 'text/html',
			(int) 1 =&gt; '*/*'
		),
		'ics' =&gt; 'text/calendar',
		'm' =&gt; 'text/plain',
		'rtf' =&gt; 'text/rtf',
		'rtx' =&gt; 'text/richtext',
		'sgm' =&gt; 'text/sgml',
		'sgml' =&gt; 'text/sgml',
		'tsv' =&gt; 'text/tab-separated-values',
		'tpl' =&gt; 'text/template',
		'txt' =&gt; 'text/plain',
		'text' =&gt; 'text/plain',
		'avi' =&gt; 'video/x-msvideo',
		'fli' =&gt; 'video/x-fli',
		'mov' =&gt; 'video/quicktime',
		'movie' =&gt; 'video/x-sgi-movie',
		'mpe' =&gt; 'video/mpeg',
		'mpeg' =&gt; 'video/mpeg',
		'mpg' =&gt; 'video/mpeg',
		'qt' =&gt; 'video/quicktime',
		'viv' =&gt; 'video/vnd.vivo',
		'vivo' =&gt; 'video/vnd.vivo',
		'ogv' =&gt; 'video/ogg',
		'webm' =&gt; 'video/webm',
		'mp4' =&gt; 'video/mp4',
		'm4v' =&gt; 'video/mp4',
		'f4v' =&gt; 'video/mp4',
		'f4p' =&gt; 'video/mp4',
		'm4a' =&gt; 'audio/mp4',
		'f4a' =&gt; 'audio/mp4',
		'f4b' =&gt; 'audio/mp4',
		'gif' =&gt; 'image/gif',
		'ief' =&gt; 'image/ief',
		'jpg' =&gt; 'image/jpeg',
		'jpeg' =&gt; 'image/jpeg',
		'jpe' =&gt; 'image/jpeg',
		'pbm' =&gt; 'image/x-portable-bitmap',
		'pgm' =&gt; 'image/x-portable-graymap',
		'png' =&gt; 'image/png',
		'pnm' =&gt; 'image/x-portable-anymap',
		'ppm' =&gt; 'image/x-portable-pixmap',
		'ras' =&gt; 'image/cmu-raster',
		'rgb' =&gt; 'image/x-rgb',
		'tif' =&gt; 'image/tiff',
		'tiff' =&gt; 'image/tiff',
		'xbm' =&gt; 'image/x-xbitmap',
		'xpm' =&gt; 'image/x-xpixmap',
		'xwd' =&gt; 'image/x-xwindowdump',
		'ice' =&gt; 'x-conference/x-cooltalk',
		'iges' =&gt; 'model/iges',
		'igs' =&gt; 'model/iges',
		'mesh' =&gt; 'model/mesh',
		'msh' =&gt; 'model/mesh',
		'silo' =&gt; 'model/mesh',
		'vrml' =&gt; 'model/vrml',
		'wrl' =&gt; 'model/vrml',
		'mime' =&gt; 'www/mime',
		'pdb' =&gt; 'chemical/x-pdb',
		'xyz' =&gt; 'chemical/x-pdb',
		'javascript' =&gt; 'application/javascript',
		'form' =&gt; 'application/x-www-form-urlencoded',
		'file' =&gt; 'multipart/form-data',
		'xhtml' =&gt; array(
			(int) 0 =&gt; 'application/xhtml+xml',
			(int) 1 =&gt; 'application/xhtml',
			(int) 2 =&gt; 'text/xhtml'
		),
		'xhtml-mobile' =&gt; 'application/vnd.wap.xhtml+xml',
		'atom' =&gt; 'application/atom+xml',
		'amf' =&gt; 'application/x-amf',
		'wap' =&gt; array(
			(int) 0 =&gt; 'text/vnd.wap.wml',
			(int) 1 =&gt; 'text/vnd.wap.wmlscript',
			(int) 2 =&gt; 'image/vnd.wap.wbmp'
		),
		'wml' =&gt; 'text/vnd.wap.wml',
		'wmlscript' =&gt; 'text/vnd.wap.wmlscript',
		'wbmp' =&gt; 'image/vnd.wap.wbmp',
		'woff' =&gt; 'application/x-font-woff',
		'webp' =&gt; 'image/webp',
		'appcache' =&gt; 'text/cache-manifest',
		'manifest' =&gt; 'text/cache-manifest',
		'htc' =&gt; 'text/x-component',
		'rdf' =&gt; 'application/xml',
		'crx' =&gt; 'application/x-chrome-extension',
		'oex' =&gt; 'application/x-opera-extension',
		'xpi' =&gt; 'application/x-xpinstall',
		'safariextz' =&gt; 'application/octet-stream',
		'webapp' =&gt; 'application/x-web-app-manifest+json',
		'vcf' =&gt; 'text/x-vcard',
		'vtt' =&gt; 'text/vtt',
		'mkv' =&gt; 'video/x-matroska',
		'pkpass' =&gt; 'application/vnd.apple.pkpass'
	)
	[protected] _protocol =&gt; 'HTTP/1.1'
	[protected] _status =&gt; (int) 200
	[protected] _contentType =&gt; 'text/html'
	[protected] _headers =&gt; array()
	[protected] _body =&gt; null
	[protected] _file =&gt; null
	[protected] _fileRange =&gt; null
	[protected] _charset =&gt; 'UTF-8'
	[protected] _cacheDirectives =&gt; array()
	[protected] _cookies =&gt; array()
}</pre>
                    </div>
                </li>
            </ul>


        </div>
    </div>


</section>