# Use a base image with Python and pip
FROM python:3.9-slim

# Install any dependencies required by Ansible
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
       ansible \
       ssh \
       && rm -rf /var/lib/apt/lists/*

# Set working directory
WORKDIR /ansible

# Copy Ansible playbook and related files
COPY playbook.yml /ansible/playbook.yml
COPY inventory.ini /ansible/inventory.ini
COPY roles/ /ansible/roles/

# Set environment variables, if needed
ENV ANSIBLE_HOST_KEY_CHECKING=False

# Run the Ansible playbook
CMD ["ansible-playbook", "playbook.yml", "-i", "inventory.ini"]
