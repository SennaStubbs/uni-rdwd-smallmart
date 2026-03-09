import time, os, re, sys

from selenium import webdriver
from selenium.webdriver.common.by import By
from urllib import request

# Clear screen
os.system('cls')

# Chrome browser options
chromeOptions = webdriver.ChromeOptions()
chromeOptions.add_argument('headless')

# Get product URLs
productURLs = []
try:
    with open('ProductURLs.txt', 'r') as f:
        lines = f.readlines()
        # Remove new line at the end of each entry
        for i in range(len(lines)):
            if i + 1 != len(lines):
                lines[i] = lines[i][:-1]
        
        productURLs = lines
except:
    print("Cannot open 'ProductURLs.txt' :(")
    sys.exit()

# Main directory
productsDirectory = "Products"

# Function to remove all whitespace from string
def Strip(string):
    return "".join(string.split())

# Get all product info and output into a file + download associated images
def GetProductInfo(url):
    print("Beginning '" + url + "' information retrieval.")

    # String for final text file
    productInfo = ""

    # Launch new Chrome browser
    driver = webdriver.Chrome(chromeOptions)
    # Get page
    driver.get(url)

    try:
        # Find product title element
        productTitle = driver.find_element(By.CLASS_NAME, 'product__title')
        productTitle = productTitle.find_element(By.TAG_NAME, 'h1').text.title()
        # Add to string
        productInfo += "Name:\n" + productTitle + "\n\n"

        # Create directory for this product using product name
        try:
            productDirectory = productsDirectory + "/" + Strip(productTitle)

            os.mkdir(productDirectory)
            print(f"Directory '{productDirectory}' created successfully.")
        except FileExistsError:
            print(f"Directory '{productDirectory}' already exists.")
        except PermissionError:
            print(f"Permission denied: Unable to create '{productDirectory}'.")
            sys.exit()
        except Exception as e:
            print(f"An error occurred: {e}")
            sys.exit()

        # Find product price element
        time.sleep(0.5) # Need to wait as element does not load instantly
        productPrice = driver.find_element(By.CLASS_NAME, 'price-item')
        # Try to convert into float for currency conversion
        try:
            productPrice = float(productPrice.text[4:])
            # Indian Rupee to Great British Pound (1 INR = 0.0079 GBP)
            productPrice *= 0.0079
            # Round to two decimal places
            productPrice = "£" + str(round(productPrice, 2))
        except:
            productPrice = productPrice.text
        # Add to string
        productInfo += "Price:\n" + str(productPrice) + "\n\n"

        # Find product description element
        productDescription = driver.find_element(By.CLASS_NAME, 'product__description')
        productDescription = productDescription.find_element(By.TAG_NAME, 'span')
        # Add to string
        productInfo += "Description:\n" + str(productDescription.text) + "\n\n"

        # Find variants
        productVariants = driver.find_element(By.CLASS_NAME, 'product-form__input')
        if productVariants:
            try:
                productVariantsTitle = productVariants.find_element(By.TAG_NAME, 'legend').text
                
                productInfo += productVariantsTitle + ":\n"
                productVariants = productVariants.find_elements(By.TAG_NAME, 'label')
                for productVariant in productVariants:
                    productVariant = productVariant.text

                    # Remove unavailable span if it exists
                    search = re.search("\n.*", productVariant)
                    if search:
                        productVariant = productVariant[:len(productVariant) - len(search.group())]
                    productInfo += productVariant + "\n"

                productInfo += "\n"
            except:
                print("Could not get variants.")

        # Find product media container
        productMedia = driver.find_element(By.CLASS_NAME, 'product__media-list')
        productMedia = productMedia.find_elements(By.TAG_NAME, 'li')

        # Loop through all media items
        imageSources = [] # Sources of images for each media item
        for media in productMedia:
            # Get image
            media = media.find_element(By.CLASS_NAME, 'product__media')
            image = media.find_element(By.TAG_NAME, 'img')
            imageSources.append(image.get_property('src'))
            # print(image.get_property('src'))

        imageFileTypes = ["jpg", "jpeg", "webp", "png"] # List of valid file types for image

        # Loop through image sources and download images
        for source in imageSources:
            # Check file type of source
            fileType = ""
            for _fileType in imageFileTypes:
                if re.search("\." + _fileType, source):
                    fileType = _fileType
            
            if fileType != "":
                # Download image
                request.urlretrieve(source, productDirectory + "/" + Strip(productTitle) + "_" + str(imageSources.index(source) + 1) + "." + fileType)

        # Create text file for product information
        with open(productDirectory + "/" + "ProductInfo.txt", "w+") as f:
            f.write(productInfo)

        # Close browser
        driver.quit()

        print("Complete!\n")
    except:
        print("Something went wrong with '" + url + "' :(")

for url in productURLs:
    GetProductInfo(url)

print("Script ended. Press ENTER to exit")
input()