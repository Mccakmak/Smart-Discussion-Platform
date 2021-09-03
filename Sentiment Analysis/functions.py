import pandas as pd
import re                       #Regular Expression Operations
import string
import numpy as np
import pickle
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
from nltk.stem import PorterStemmer
from nltk.stem import WordNetLemmatizer
from sklearn.feature_extraction.text import TfidfVectorizer
from IPython.display import display
from pandas import option_context


def load_dataset(filename, cols):
    np.random.seed(34)  # Randomization
    #dataset = pd.read_csv(filename, encoding="latin-1", header=0, skiprows=lambda x: (x > 0) & (np.random.random() > percent))
    #dataset = pd.read_csv(filename, encoding='latin-1', nrows=100000)
    dataset = pd.read_csv(filename, encoding='latin-1')
    dataset.columns = cols
    with option_context('display.max_colwidth', 500):
        display(dataset.head(5))
        print("Data has " + str(dataset.shape[0]) + " rows, " + str(dataset.shape[1]) + " columns.")
    return dataset

def remove_unwanted_cols(dataset, cols):
    for col in cols:
        del dataset[col]

    with option_context('display.max_colwidth', 500):
        display(dataset.head(5))
    return dataset

def preprocess_tweet_text(tweet):

    tweet = str(tweet)
    # Lower tweets
    tweet = tweet.lower()
    # Remove urls
    tweet = re.sub(r"http\S+|www\S+|https\S+", '', tweet, flags=re.MULTILINE)
    # Remove mentions "@" and hashtags "# and RT"
    tweet = re.sub(r'\@\w+|\#|\brt|\bamp','', tweet)

    emoji_pattern = re.compile("["
                               u"\U0001F600-\U0001F64F"  # emoticons
                               u"\U0001F300-\U0001F5FF"  # symbols & pictographs
                               u"\U0001F680-\U0001F6FF"  # transport & map symbols
                               u"\U0001F1E0-\U0001F1FF"  # flags (iOS)
                               u"\U00002500-\U00002BEF"  # chinese char
                               u"\U00002702-\U000027B0"
                               u"\U00002702-\U000027B0"
                               u"\U000024C2-\U0001F251"
                               u"\U0001f926-\U0001f937"
                               u"\U00010000-\U0010ffff"
                               u"\u2640-\u2642"
                               u"\u2600-\u2B55"
                               u"\u200d"
                               u"\u23cf"
                               u"\u23e9"
                               u"\u231a"
                               u"\ufe0f"  # dingbats
                               u"\u3030"
                               "]+", flags=re.UNICODE)
    tweet = emoji_pattern.sub(r'', tweet)

    # Replace all non alphabets.
    tweet = re.sub("[^a-zA-Z0-9]", " ", tweet)

    # Replace 3 or more consecutive letters by 2 letter.
    tweet = re.sub(r"(.)\1\1+", r"\1\1", tweet)

    # Remove punctuations
    tweet = tweet.translate(str.maketrans("", "", string.punctuation))
    # Remove stopwords
    filtered_words = []
    tweet_tokens = word_tokenize(tweet)
    for word in tweet_tokens:
        if word not in stopwords.words("english"):
            filtered_words.append(word)
    #Normalization
    #ps = PorterStemmer()
    #stemmed_words = [ps.stem(w) for w in filtered_words]
    #lemmatizer = WordNetLemmatizer()
    #lemma_words = [lemmatizer.lemmatize(word) for word in filtered_words]

    return " ".join(filtered_words)

def get_feature_vector(train_fit):
    vector = TfidfVectorizer(sublinear_tf = True)
    vector.fit(train_fit)
    return vector

def int_to_string(sentiment):
    if sentiment == -1:
        return "Negative"
    elif sentiment == 0:
        return "Neutral"
    elif sentiment == 1:
        return "Positive"


def load_model():
    file = open('LSVC_model.pickle', 'rb')
    LSVC_model = pickle.load(file)
    file.close()
    return LSVC_model