# API Call Plugin

## Description

The **API Call Plugin** is a WordPress plugin designed to consume an API and return beautified JSON. It registers a custom REST API route and handles requests to fetch data from the provided API URL.

## Features

- Registers a custom REST API route.
- Handles `POST` requests to fetch data from the provided API URL.
- Returns JSON data or PDF content as appropriate.

## Installation

1. Download the plugin files.
2. Upload the entire plugin folder to the `/wp-content/plugins/` directory.
3. Activate the plugin through the 'Plugins' menu in WordPress.

## Usage

1. Make a `POST` request to the custom REST API route `/wp-json/api-consumer/v1/fetch/` with a JSON body containing the `api_url` parameter.
2. The plugin will fetch data from the provided API URL and return the JSON response or the PDF content if the API responds with a PDF file.

## Example Request

```sh
curl -X POST https://yourwordpresssite.com/wp-json/api-consumer/v1/fetch/ \
-H "Content-Type: application/json" \
-d '{"api_url": "https://example.com/api/data"}'
```
