<?php

return array (
  'fields' => 
  array (
    'name' => 
    array (
      'label' => 'Name',
      'placeholder' => 'Enter a name for the address',
      'help' => 'A descriptive name for this address (e.g. Home, Office)',
      'description' => 'Identifying name for the address',
      'helper_text' => '',
    ),
    'country' => 
    array (
      'label' => 'Country',
      'placeholder' => 'Enter the country',
      'help' => 'Country where the address is located',
      'description' => 'Country of belonging',
      'helper_text' => '',
    ),
    'administrative_area_level_1' => 
    array (
      'label' => 'Region',
      'placeholder' => 'Enter the region',
      'help' => 'Administrative region (e.g. Lombardy)',
      'description' => 'Administrative region',
      'helper_text' => '',
    ),
    'administrative_area_level_2' => 
    array (
      'label' => 'Province',
      'placeholder' => 'Enter the province',
      'help' => 'Province or state',
      'description' => 'Province of belonging',
      'helper_text' => '',
    ),
    'administrative_area_level_3' => 
    array (
      'label' => 'Municipality',
      'placeholder' => 'Enter the municipality',
      'help' => 'Municipality or local district',
      'description' => 'Municipality of belonging',
      'helper_text' => '',
    ),
    'locality' => 
    array (
      'label' => 'City',
      'placeholder' => 'Enter the city',
      'help' => 'City or town',
      'description' => 'City or locality',
      'helper_text' => '',
    ),
    'postal_code' => 
    array (
      'label' => 'Postal Code',
      'placeholder' => 'Enter the postal code',
      'help' => 'ZIP or postal code',
      'description' => 'Postal code',
      'helper_text' => '',
    ),
    'route' => 
    array (
      'label' => 'Street',
      'placeholder' => 'Enter the street name',
      'help' => 'Street or road name',
      'description' => 'Street or road name',
      'helper_text' => '',
    ),
    'street_number' => 
    array (
      'label' => 'Street Number',
      'placeholder' => 'Enter the street number',
      'help' => 'Building or house number',
      'description' => 'Building or house number',
      'helper_text' => '',
    ),
    'is_primary' => 
    array (
      'label' => 'Primary Address',
      'placeholder' => 'Set as primary address',
      'help' => 'Mark this address as the primary one',
      'description' => 'Primary address',
      'helper_text' => '',
    ),
    'model_type' => 
    array (
      'label' => 'Model Type',
      'placeholder' => 'Select the model type',
      'help' => 'Type of model associated with the address',
      'description' => 'Type of model that owns this address',
      'helper_text' => '',
    ),
    'model_id' => 
    array (
      'label' => 'Model ID',
      'placeholder' => 'Enter the model ID',
      'help' => 'Identifier of the associated model',
      'description' => 'ID of the model that owns this address',
      'helper_text' => '',
    ),
    'description' => 
    array (
      'label' => 'Description',
      'placeholder' => 'Enter a description',
      'help' => 'Additional notes about the address',
      'description' => 'Additional description of the address',
      'helper_text' => '',
    ),
    'formatted_address' => 
    array (
      'label' => 'Formatted Address',
      'placeholder' => 'Full formatted address',
      'help' => 'Complete formatted address',
      'description' => 'Complete formatted address',
      'helper_text' => '',
    ),
    'place_id' => 
    array (
      'label' => 'Place ID',
      'placeholder' => 'Google Maps reference ID',
      'help' => 'Google Maps identifier for the place',
      'description' => 'Google Maps identifier for the place',
      'helper_text' => '',
    ),
    'latitude' => 
    array (
      'label' => 'Latitude',
      'placeholder' => 'Enter latitude',
      'help' => 'Geographic latitude coordinates',
      'description' => 'Geographic latitude coordinates',
      'helper_text' => '',
    ),
    'longitude' => 
    array (
      'label' => 'Longitude',
      'placeholder' => 'Enter longitude',
      'help' => 'Geographic longitude coordinates',
      'description' => 'Geographic longitude coordinates',
      'helper_text' => '',
    ),
    'type' => 
    array (
      'label' => 'Type',
      'placeholder' => 'Select address type',
      'help' => 'Type of address (home, work, etc.)',
      'description' => 'Type of address',
      'helper_text' => '',
      'options' => 
      array (
        'billing' => 'Billing',
        'shipping' => 'Shipping',
        'home' => 'Home',
        'work' => 'Work',
        'other' => 'Other',
      ),
    ),
    'extra_data' => 
    array (
      'label' => 'Extra Data',
      'placeholder' => 'Enter extra data',
      'help' => 'Additional information about the address',
      'description' => 'Additional data of the address',
      'helper_text' => '',
    ),
    'full_address' => 
    array (
      'label' => 'Full Address',
      'placeholder' => '',
      'help' => 'Complete formatted address',
      'description' => 'Complete formatted address',
      'helper_text' => '',
    ),
    'street_address' => 
    array (
      'label' => 'Street Address',
      'placeholder' => '',
      'help' => 'Complete street address',
      'description' => 'Complete street address',
      'helper_text' => '',
    ),
    'map' => 
    array (
      'label' => 'Map',
      'placeholder' => '',
      'help' => 'Map view',
      'description' => 'Map view',
      'helper_text' => '',
    ),
    'province' => 
    array (
      'description' => 'province',
      'helper_text' => '',
      'placeholder' => 'province',
      'label' => 'Province',
    ),
    'region' => 
    array (
      'label' => 'Region',
      'placeholder' => 'Region',
      'helper_text' => '',
      'description' => 'Region',
    ),
  ),
  'singular' => 'Address',
  'plural' => 'Addresses',
  'navigation' => 
  array (
    'sort' => 96,
    'icon' => 'heroicon-o-cog',
    'group' => 'Geo',
  ),
  'actions' => 
  array (
    'create' => 'Create address',
    'edit' => 'Edit address',
    'view' => 'View address',
    'delete' => 'Delete address',
    'set_primary' => 'Set as primary',
    'verify' => 'Verify address',
    'geocode' => 'Geocode',
  ),
  'columns' => 
  array (
    'name' => 'Name',
    'full_address' => 'Full Address',
    'type' => 'Type',
    'is_primary' => 'Primary',
    'locality' => 'City',
    'postal_code' => 'Postal Code',
    'model' => 'Associated to',
  ),
  'messages' => 
  array (
    'primary_set' => 'Address set as primary successfully',
    'address_verified' => 'Address verified successfully',
    'geocoding_success' => 'Geocoding completed successfully',
    'geocoding_failed' => 'Unable to geocode the address',
  ),
  'sections' => 
  array (
    'location' => 
    array (
      'label' => 'Location Information',
      'description' => 'Geographical position data',
    ),
    'address' => 
    array (
      'label' => 'Address Data',
      'description' => 'Address details',
    ),
    'metadata' => 
    array (
      'label' => 'Metadata',
      'description' => 'Additional address information',
    ),
    'map' => 
    array (
      'label' => 'Map',
      'description' => 'Map view',
    ),
  ),
);
