# Raw — Nextcloud raw file server

Raw simply returns any requested file, so you can link directly to a file itself (i.e. without any
of NextCloud's interface around it). This enables you to host static web pages, images or other
files, for example to link/embed them elsewhere on the web.

For security and privacy, the content is served with a [Content-Security-Policy][] header. This
header instructs browsers to not load any remote content, nor execute any scripts that it may
contain (of course, the downside is that your web pages cannot use javascript for interactivity).

## Usage

The common usage is to first share a file and enable public access through a link. If the share link
is `https://my-nextcloud/s/aBc123DeF456xyZ`, then this app will provide access to the raw file at
`https://my-nextcloud/apps/raw/s/aBc123DeF456xyZ`.

Private files are also hosted by this app, but of course only to users that are logged in and
have permission to read them. For example, a file named `test.html` in the Documents folder would be
available at `https://my-nextcloud/apps/raw/files/Documents/test.html`.

[Content-Security-Policy]: https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers/Content-Security-Policy
