from math import radians, cos, sin, asin, sqrt

#from https://stackoverflow.com/a/4913653
def haversine(lon1, lat1, lon2, lat2):
    """
    Calculate the great circle distance in kilometers between two points
    on the earth (specified in decimal degrees)
    """
    # convert decimal degrees to radians
    lon1, lat1, lon2, lat2 = map(radians, [lon1, lat1, lon2, lat2])

    # haversine formula
    dlon = lon2 - lon1
    dlat = lat2 - lat1
    a = sin(dlat/2)**2 + cos(lat1) * cos(lat2) * sin(dlon/2)**2
    c = 2 * asin(sqrt(a))
    r = 6371 # Radius of earth in kilometers. Use 3956 for miles. Determines return value units.
    return c * r


locations = [
    	  {'id': 1000, 'zip_code': '37069', 'lat': 45.35, 'lng': 10.84},
    	  {'id': 1001, 'zip_code': '37121', 'lat': 45.44, 'lng': 10.99},
    	  {'id': 1002, 'zip_code': '37129', 'lat': 45.44, 'lng': 11.00},
          {'id': 1003, 'zip_code': '37133', 'lat': 45.43, 'lng': 11.02}
]

shoppers = [
    {'id': 'S1', 'lat': 45.46, 'lng': 11.03, 'enabled': True},
    {'id': 'S2', 'lat': 45.46, 'lng': 10.12, 'enabled': True},
    {'id': 'S3', 'lat': 45.34, 'lng': 10.81, 'enabled': True},
    {'id': 'S4', 'lat': 45.76, 'lng': 10.57, 'enabled': True},
    {'id': 'S5', 'lat': 45.34, 'lng': 10.63, 'enabled': True},
    {'id': 'S6', 'lat': 45.42, 'lng': 10.81, 'enabled': True},
    {'id': 'S7', 'lat': 45.34, 'lng': 10.94, 'enabled': True},
]

def shopper_coverage(lon, lat):
    covered = 0
    total = 0
    for l in locations:
        if( haversine(lon, lat, l['lng'], l['lat']) < 10):
            #print("location ID " + str(l['id']) + " is within 10 kms!\n")
            covered += 1
        total += 1
    return round(100*covered/total)

def coverage():
    sorted = []
    for shopper in shoppers:
        if(shopper['enabled']):
            sorted.append( { 'id': shopper['id'], 'coverage': shopper_coverage(shopper['lng'], shopper['lat']) })

    sorted.sort(key=lambda x: x['coverage'], reverse=True)
    return sorted

