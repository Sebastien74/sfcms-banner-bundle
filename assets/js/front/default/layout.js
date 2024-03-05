/** Banner bundle */
let banner = body.querySelectorAll('[data-component="banner"]');
if (banner.length > 0) {
    import(/* webpackPreload: true */ './components/banner').then(({default: banner}) => {
        new banner();
    }).catch(error => console.error(error.message));
}