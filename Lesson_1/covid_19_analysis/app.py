import pandas as pd
import folium
from flask import Flask, render_template


app = Flask(__name__)

# Corona Data
corona_data = pd.read_csv('covid-19-dataset-1.csv')
corona_data = corona_data.dropna()

# Sort by Country
sort_by_country = corona_data.groupby('Country_Region').sum([['Confirmed', 'Deaths', 'Recovered', 'Actived']])


# find_top_confirmed
def find_top_confirmed(n):
    cdf=sort_by_country.nlargest(n, 'Confirmed')[['Confirmed']]
    return cdf

cdf= find_top_confirmed(15)

pairs=[(province_state,confirmed) for province_state,confirmed in zip(cdf.index,cdf['Confirmed'])]


# Folium Map

m = folium.Map(
    location=[34.223334,-82.461707],
    tiles="Stamen toner",
    zoom_start=8
)

# Make Circles On Map

def make_circles(x):
    folium.Circle(
        location=[x[0],x[1]],
        radius=float(x[2]) * 10,
        fill=True,
        stroke=False,
        color= "red",
        popup='{}\n Confirmed cases: {}'.format(x[3],x[2])
    ).add_to(m)

corona_data[['Lat', 'Long_', 'Confirmed', 'Combined_Key']].apply(lambda x:make_circles(x),axis=1)

html_map = m._repr_html_()


@app.route('/')

def home():
    return render_template('home.html', table=cdf, cmap=html_map, pairs=pairs)

if __name__ == '__main__':
    app.run(debug=True)





