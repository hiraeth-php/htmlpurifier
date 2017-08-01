HTMLPurifier is a robust and highly configurable filter for HTML content to ensure security and cleanliness of user inputted HTML.

## Installation

```
composer require hiraeth/htmlpurifier
```

The `htmlpurifier.jin` configuration will be automatically copied to your `config` directory via [opus](https://github.com/imarc/opus).

## Delegates

| Operative Class          | Operative Intefaces  | Provides
|--------------------------|----------------------|------------------------------------------------------
| `HTMLPurifier`           | Class Only           | Configuration for common HTMLPurifier settings

## Providers

No providers are included in this package.

## Configuration

```ini
; The location to store serialized purifier information.  This is essentially a cache.

cache_path = writable/cache/htmlpurifier

; Whether or not we should remove empty elements.  Note that if this is set to true, elements containing only
; non-breaking space characters will also be removed.

remove_empty = true

; Whether or not the HTML we're purifying should be considered trusted.

trusted = false

; Forbidden HTML (attributes, elements, classes)

forbidden = {
	"attributes": [],
	"elements": [],
	"classes": []
}
```

## Usage

See [the HTMLPurifier documentation](http://htmlpurifier.org/docs) for more information on what how to use the purifier.  Additional configuration will be normalized with time.  If you have specific requests, please submit an issue or pull request.
