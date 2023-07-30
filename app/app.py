from flask import Flask, request, jsonify, make_response
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
from flaskext.mysql import MySQL
import pymysql
import pandas as pd
import warnings
from datetime import datetime
warnings.simplefilter(action='ignore', category=FutureWarning)

app = Flask(__name__)

# Create an instance of MySQL
mysql = MySQL()

# Set database credentials in config.
app.config['MYSQL_DATABASE_USER'] = 'root'
app.config['MYSQL_DATABASE_PASSWORD'] = ''
app.config['MYSQL_DATABASE_DB'] = 'lvtn'
app.config['MYSQL_DATABASE_HOST'] = 'localhost'

# Initialize the MySQL extension
mysql.init_app(app)


def detai():
    try:
        dict_result = dict()
        conn = mysql.connect()
        cur = conn.cursor(pymysql.cursors.DictCursor)
        cur.execute("SELECT iddt,tendetai FROM detai")
        row = cur.fetchall()
        for i in row:
            key = i.get('iddt')
            values = i.get('tendetai')
            dict_result[key] = values
        return make_response(jsonify({"dogoiy": dict_result}), 200)
    except Exception as e:
        cur.close()
        conn.close()
        print(e)


    
def updateRecommend(iddt, arrRecommend):
    conn = mysql.connect()
    cur = conn.cursor()
    for x in arrRecommend:
        cur.execute(
            "INSERT INTO dogoiy(id,madetaigoiy,dotuongtu) VALUES (%s, %s, %s)", (iddt, x[0], x[1]))
    cur.close()
    conn.commit()
    conn.close()
    return make_response(jsonify({"notify": 200}), 200)


@app.route('/tinhgoiy', methods=['GET'])
def tinhgoiy():
    try:
        reponse = detai().get_json()
        document = reponse.get("dogoiy")
        d = list(document.values())
        tfidf_vectorizer = TfidfVectorizer()
        tfidf_matrix = tfidf_vectorizer.fit_transform(d)
        # filter vector
        total_words = tfidf_matrix.sum(axis=0)
        print(total_words)
        # lấy ra các từ vector đúng với tần số xuất hiện
        freq = [(word, total_words[0, idx])
                for word, idx in tfidf_vectorizer.vocabulary_.items()]
        freq = sorted(freq, key=lambda x: x[1], reverse=True)
        print(freq)
        freq_df = pd.DataFrame(freq)
        freq_df.rename(columns={0: 'word', 1: 'count'}, inplace=True)
        print(freq_df)
        # Từ có tần số xuất hiện  > 1000
        test = freq_df[freq_df['count'] >= 0.5]
        freq_arr = pd.Series(test.word)
        print(freq_arr)
        # cho ra vector mới
        tfidf_matrix_new = tfidf_vectorizer.fit(freq_arr).transform(d)
        # get vector name
        vectorName = tfidf_vectorizer.get_feature_names_out()
        # count vector name
        countVectorName = len(vectorName)
        # Array contain id document get by Json
        listIdDocument = list(document.keys())

        for x in range(len(d)):
            tempCosine = dict()
            cosine = cosine_similarity(tfidf_matrix_new[x], tfidf_matrix_new)
            for y in range(len(cosine[0])):
                if y == x:
                    continue
                if cosine[0][y] > 0:
                    print("Id de tai: " + str(listIdDocument[y]))
                    print("Index  "+str(y) +
                          " Consine "+str(cosine[0][y]))
                    tempCosine[listIdDocument[y]] = cosine[0][y]

            print(len(tempCosine))
            if len(tempCosine) == 0:
                continue

            # sort and limit 5
            sort_order = sorted(tempCosine.items(),
                                key=lambda x: x[1], reverse=True)[:5]
            
            # insert into database
            reponseUpdate = updateRecommend(
                listIdDocument[x], sort_order).get_json()
            notify = reponseUpdate.get("notify")
            if notify == 200:
                print("update recommend success for id " +
                      str(listIdDocument[x]))
        return jsonify({"notify": 200})
    except NameError:
        print("Variable x is not defined")
        return jsonify({"notify": 500})



if __name__ == "__main__":
    app.run()
