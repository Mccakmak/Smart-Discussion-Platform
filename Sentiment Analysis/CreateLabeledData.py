import pandas as pd
import numpy as np
from functions import load_dataset
from functions import remove_unwanted_cols
# Convert tsv file to csv file
#tsv_file='t4sa_text_sentiment.tsv'
#csv_table=pd.read_table(tsv_file, sep='\t')
#csv_table.to_csv('t4sa_text_sentiment.csv', index=False)

#scored_tweets = pd.read_csv('t4sa_text_sentiment.csv')
#raw_tweets = pd.read_csv('raw_tweets_text.csv')

# Merge the two csv file with the tweet ids
#merged = scored_tweets.merge(raw_tweets, on='id')
#merged.to_csv("not_labeled.csv", index=False)

old_train = load_dataset("old_training.csv", ["label", "id", "created_at", "query", "user", "text"])
remove_unwanted_cols(old_train, ["id", "created_at", "query", "user"])
labeled = pd.read_csv('cleaned_dataset.csv', encoding='latin-1')
merged = labeled.merge(old_train, how='outer')


"""
not_labeled = pd.read_csv("not_labeled.csv")
not_labeled.insert(1, 'label', np.nan)

# Take above 0.85
threshold = 0.85

for i in range(len(not_labeled)):

    neg_score = not_labeled['NEG'][i]
    neut_score  = not_labeled['NEU'][i]
    pos_score = not_labeled['POS'][i]

    if float(neg_score) > threshold:
        label = -1
        not_labeled.at[i, 'label'] = label
    if float(neut_score) > threshold:
        label = 0
        not_labeled.at[i, 'label'] = label
    if float(pos_score) > threshold:
        label = 1
        not_labeled.at[i, 'label'] = label

before_drop = not_labeled.shape[0]

not_labeled = not_labeled.drop_duplicates(subset=['text'])
after_drop_dub = not_labeled.shape[0]

not_labeled = not_labeled.dropna()
after_all_drop = not_labeled.shape[0]

not_labeled.to_csv("labeled_" + str(threshold) + ".csv", index=False)
"""

before_drop =  merged.shape[0]
merged = merged.drop_duplicates(subset=['text'])
after_drop_dub = merged.shape[0]
print("Dublicate dropped rows: " + str(before_drop - after_drop_dub ))

merged.to_csv("merged_labeled_training.csv", index=False)